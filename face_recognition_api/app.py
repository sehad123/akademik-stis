# # from flask import Flask, request, jsonify
# # from deepface import DeepFace
# # import cv2
# # import numpy as np
# # import base64
# # from flask_sqlalchemy import SQLAlchemy
# # import os

# # app = Flask(__name__)

# # # Konfigurasi database
# # app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/stis.com'
# # db = SQLAlchemy(app)

# # class User(db.Model):
# #     __tablename__ = 'users'
# #     id = db.Column(db.Integer, primary_key=True)
# #     email = db.Column(db.String(120), unique=True, nullable=False)
# #     profile_pic = db.Column(db.String(120), nullable=True)

# # @app.route('/verify-face', methods=['POST'])
# # def verify_face():
# #     image_data = request.json['image']
# #     image_data = image_data.split(',')[1]
# #     decoded_image = np.frombuffer(base64.b64decode(image_data), np.uint8)
# #     image = cv2.imdecode(decoded_image, cv2.IMREAD_COLOR)

# #     users = User.query.all()
# #     for user in users:
# #         if user.profile_pic and os.path.exists(user.profile_pic):
# #             result = DeepFace.verify(img1_path=image, img2_path=user.profile_pic)
# #             if result['verified']:
# #                 return jsonify({'status': 'success', 'user_id': user.id, 'email': user.email})
    
# #     return jsonify({'status': 'error', 'message': 'Face not recognized'})

# # if __name__ == '__main__':
# #     app.run(debug=True)



# from flask import Flask, request, jsonify
# from flask_cors import CORS
# import base64
# import os

# app = Flask(__name__)
# CORS(app)

# @app.route('/verify-face', methods=['POST'])
# def verify_face():
#     data = request.get_json()
#     image_data = data['image']

#     # Decode the image
#     image_data = base64.b64decode(image_data.split(',')[1])

#     # Save the image for processing
#     filename = 'uploaded_face.png'
#     with open(filename, 'wb') as f:
#         f.write(image_data)

#     # Implement face recognition logic here
#     # For now, we'll just simulate success
#     user_recognized = True  # Replace with actual face recognition logic

#     if user_recognized:
#         return jsonify(status='success', redirect_url='http://localhost:85/akademik.stis/dosen/dashboard')
#     else:
#         return jsonify(status='error', message='Face not recognized')

# if __name__ == '__main__':
#     app.run(port=5000, debug=True)





from deepface import DeepFace
import mysql.connector
import base64
import os
from flask import Flask, request, jsonify
import logging

app = Flask(__name__)

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Database configuration
db_config = {
    'user': 'root',
    'password': '',
    'host': '127.0.0.1',
    'database': 'stis.com',
}

def get_user_image(user_id):
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()
    cursor.execute("SELECT profile_pic FROM users WHERE id = %s", (user_id,))
    result = cursor.fetchone()
    conn.close()
    if result:
        return result[0]  # profile_pic column
    return None

def save_image_from_base64(image_data, filename):
    # Ensure the base64 string has correct padding
    if ',' in image_data:
        image_data = image_data.split(',')[1]
    
    missing_padding = len(image_data) % 4
    if missing_padding:
        image_data += '=' * (4 - missing_padding)

    image_data = base64.b64decode(image_data)
    
    with open(filename, 'wb') as f:
        f.write(image_data)

@app.route('/compare_faces', methods=['POST'])
def compare_faces():
    data = request.json
    user_id = data.get('user_id')
    uploaded_image_base64 = data.get('uploaded_image')

    logger.info(f"Received user_id: {user_id}")
    logger.info(f"Received uploaded_image_base64: {uploaded_image_base64[:30]}...")  # Log only the first 30 characters

    user_image_filename = 'user_image.jpg'
    profile_pic = get_user_image(user_id)
    if not profile_pic:
        return jsonify({'status': 'error', 'message': 'User profile picture not found'})

    save_image_from_base64(profile_pic, user_image_filename)
    uploaded_image_filename = 'uploaded_image.jpg'
    save_image_from_base64(uploaded_image_base64, uploaded_image_filename)

    try:
        result = DeepFace.verify(uploaded_image_filename, user_image_filename)
        os.remove(user_image_filename)
        os.remove(uploaded_image_filename)
        if result['verified']:
            return jsonify({'status': 'success', 'message': 'Face verified successfully'})
        else:
            return jsonify({'status': 'error', 'message': 'Face verification failed'})
    except Exception as e:
        logger.error(f"Error in face verification: {e}")
        return jsonify({'status': 'error', 'message': str(e)})

if __name__ == '__main__':
    app.run(port=5000)
