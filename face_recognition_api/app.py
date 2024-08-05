import os
import re
import base64
import logging
import numpy as np
from flask import Flask, request, jsonify
from PIL import Image
import mysql.connector
from flask_cors import CORS
from facenet_pytorch import MTCNN, InceptionResnetV1

app = Flask(__name__)
CORS(app)  # Ini akan mengaktifkan CORS untuk semua rute

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Konfigurasi Database
db_config = {
    'user': 'root',
    'password': '',
    'host': '127.0.0.1',
    'database': 'stis.com',
}

UPLOAD_FOLDER = 'upload/presensi/'
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

def get_user_image(user_id):
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()
    cursor.execute("SELECT profile_pic FROM users WHERE id = %s", (user_id,))
    result = cursor.fetchone()
    conn.close()
    if result and result[0]:
        image_path = os.path.join('upload', 'profile', result[0])
        absolute_image_path = os.path.abspath(image_path)
        logger.info(f"Memeriksa keberadaan foto profil di: {absolute_image_path}")
        if os.path.exists(absolute_image_path):
            return absolute_image_path
        else:
            logger.error(f"Foto profil tidak ada di: {absolute_image_path}")
            return None
    logger.error(f"Tidak ditemukan foto profil untuk id pengguna: {user_id}")
    return None

def save_image_from_base64(image_data, filename):
    if ',' in image_data:
        image_data = image_data.split(',')[1]
    image_data = re.sub(r'[^A-Za-z0-9+/]', '', image_data)
    
    # Tambahkan padding jika perlu
    missing_padding = len(image_data) % 4
    if missing_padding:
        image_data += '=' * (4 - missing_padding)

    try:
        image_data = base64.b64decode(image_data)
        with open(filename, 'wb') as f:
            f.write(image_data)
        logger.info(f"Gambar berhasil disimpan: {filename}")

    except Exception as e:
        logger.error(f"Kesalahan saat menyimpan gambar: {e}")
        raise ValueError("Kesalahan saat menyimpan gambar")

def read_image(image_path):
    try:
        image = Image.open(image_path)
        if image.mode != 'RGB':
            image = image.convert('RGB')  # Pastikan gambar dalam format RGB
        return np.array(image)
    except Exception as e:
        logger.error(f"Kesalahan saat membaca gambar: {e}")
        raise ValueError("Kesalahan saat membaca gambar")

def detect_face_mtcnn(image):
    mtcnn = MTCNN(keep_all=True)
    image = Image.fromarray(image)
    faces, _ = mtcnn(image, return_prob=True)
    if faces is not None and len(faces) > 0:
        return faces[0]
    raise ValueError("Tidak ada wajah terdeteksi dalam gambar")

def get_face_embedding(face):
    model = InceptionResnetV1(pretrained='vggface2').eval()
    face = face.unsqueeze(0)
    embedding = model(face)
    return embedding

def compare_faces(embedding1, embedding2, threshold=0.6):
    distance = (embedding1 - embedding2).norm().item()
    return distance < threshold

@app.route('/compare_faces', methods=['POST'])
def compare_faces_route():
    data = request.json
    user_id = data.get('user_id')
    uploaded_image_base64 = data.get('uploaded_image')

    logger.info(f"Menerima user_id: {user_id}")
    logger.info(f"Menerima uploaded_image_base64: {uploaded_image_base64[:30]}...")

    profile_pic_path = get_user_image(user_id)
    if not profile_pic_path:
        return jsonify({'status': 'error', 'message': 'Foto profil pengguna tidak ditemukan'}), 404

    logger.info(f"Path foto profil: {profile_pic_path}")

    uploaded_image_filename = 'uploaded_image.jpg'

    try:
        save_image_from_base64(uploaded_image_base64, uploaded_image_filename)
    except ValueError as e:
        return jsonify({'status': 'error', 'message': str(e)}), 400

    try:
        profile_pic_path = os.path.abspath(profile_pic_path)
        logger.info(f"Path absolut foto profil: {profile_pic_path}")

        if not os.path.exists(profile_pic_path):
            logger.error(f"Berkas gambar pengguna tidak ada: {profile_pic_path}")
            return jsonify({'status': 'error', 'message': 'Berkas gambar pengguna tidak ditemukan'}), 404

        if not os.path.exists(uploaded_image_filename):
            logger.error(f"Berkas gambar yang diunggah tidak ada: {uploaded_image_filename}")
            return jsonify({'status': 'error', 'message': 'Berkas gambar yang diunggah tidak ditemukan'}), 404

        user_image = read_image(profile_pic_path)
        uploaded_image = read_image(uploaded_image_filename)

        user_face = detect_face_mtcnn(user_image)
        uploaded_face = detect_face_mtcnn(uploaded_image)

        user_embedding = get_face_embedding(user_face)
        uploaded_embedding = get_face_embedding(uploaded_face)

        if compare_faces(user_embedding, uploaded_embedding):
            result = {'status': 'success', 'message': 'Wajah berhasil diverifikasi'}
        else:
            result = {'status': 'error', 'message': 'Verifikasi wajah gagal'}

        return jsonify(result)
    except Exception as e:
        logger.error(f"Kesalahan dalam verifikasi wajah: {e}")
        return jsonify({'status': 'error', 'message': str(e)}), 500
    finally:
        if os.path.exists(uploaded_image_filename):
            os.remove(uploaded_image_filename)

if __name__ == '__main__':
    app.run(debug=True)
