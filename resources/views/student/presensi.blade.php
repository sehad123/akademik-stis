@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-center">Presensi Mahasiswa</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('_message')

    <div class="container">
        <!-- Container kamera -->
        <div id="camera-container" style="display: none;">
            <video id="video" width="400" height="330" autoplay></video>
            <canvas id="canvas" width="400" height="330" style="display: none;"></canvas>
        </div>

        <div class="info-section col-sm-6 ml-4">
            <p>Nama: {{ $getMahasiswa->name }}</p>
            <p>Kelas: {{ $getClass->name }}</p>
            <p>Matkul: {{ $getMatkul->name }}</p>

            @php
            $tanggal = '';
            $start_time = '';
            $end_time = '';
            $room_number = '';
            $status = '';
            $link = '';
            $current_date = \Carbon\Carbon::now()->toDateString();
            if (!empty($getMyJadwal)) {
                $week = $getMyJadwal[0]['week'][0];
                $tanggal = $week['tanggal'];
                $start_time = $week['start_time'];
                $end_time = $week['end_time'];
                $room_number = $week['room_number'];
                $status = $week['status'];
                $link = $week['link'];
                $dosen_name = $week['dosen_name'];
                $dosen_id = $week['dosen_id'];
            }
            @endphp
            <p>dosen: {{ $dosen_name }}</p>

            <p>Hari: {{ $getDay->name }} / {{ date('d-m-Y', strtotime($tanggal)) }}</p>
            <p>Jam: {{ date('h:i A', strtotime($start_time)) }} - {{ date('h:i A', strtotime($end_time)) }}</p>
            <p>Status: {{ $status }}</p>
            @if ($status === "Online")
            <p>Link Zoom: <a href="{{ $link }}"> {{ $link }}</a></p>
            @else
            <p>Ruangan: {{ $room_number }}</p>
            @endif

            <!-- Menampilkan Lokasi Pengguna -->
            <p>Lokasi Anda saat ini: <span id="locationName">Mendeteksi lokasi...</span></p>
            
            <p class="lat">Latitude: <span id="latitude"></span></p>
            <p class="long">Longitude: <span id="longitude"></span></p>
            
        </div>

        <div id="map" style="height: 300px; width: 100%;"></div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body p-0">
                            @php
                            $current_time = \Carbon\Carbon::now()->format('H:i:s');
                            $class_start_time = \Carbon\Carbon::parse($start_time)->format('H:i:s');
                            $class_end_time = \Carbon\Carbon::parse($end_time)->format('H:i:s');
                            @endphp

                            @if ($current_date == $tanggal && $current_time >= $class_start_time && $current_time <= $class_end_time)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Presensi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getStudent as $value)
                                    @php
                                    $presensi_type = '';
                                    $created_at = '';
                                    $getPresensi = $value->getPresensi($getMahasiswa->id, $getClass->id, now()->toDateString(), $getMatkul->id, $getDay->id);
                                    if (!empty($getPresensi) && !empty($getPresensi->presensi_type) && !empty($getPresensi->created_at)) {
                                        $presensi_type = $getPresensi->presensi_type;
                                        $created_at = $getPresensi->created_at;
                                    }
                                    @endphp
                                    <tr>
                                        <td class="text-center">
                                            @if (empty($getPresensi->presensi_type))
                                            <button class="SavePresensi btn btn-primary m-2" data-value="1" id="{{ $value->id }}">Hadir</button>
                                            <button class="SavePresensi btn btn-warning m-2" data-value="4" id="{{ $value->id }}">Sakit</button>
                                            <button class="SavePresensi btn btn-danger m-2" data-value="5" id="{{ $value->id }}">Izin</button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!empty($getPresensi->presensi_type))
                                            @switch($presensi_type)
                                                @case(1) Hadir @break
                                                @case(2) Terlambat A @break
                                                @case(3) Terlambat B @break
                                                @case(4) Sakit @break
                                                @case(5) Izin @break
                                                @case(6) Tidak Hadir @break
                                                @default {{ " " }}
                                            @endswitch
                                            @else
                                            {{ " " }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!empty($created_at))
                                            Anda Presensi pada = {{ date('d-m-Y / H:i A ', strtotime($created_at)) }}
                                            @else
                                            Jam Presensi anda = {{ " " }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center">Presensi akan dibuka saat memasuki waktu kelas.</p>
                            <div class="countdown-container text-center">
                                {{-- <h4>Presensi akan dimulai dalam:</h4> --}}
                                <h4 id="countdown-timer"></h4>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')

<script type="text/javascript">
var locationDetected = false; // Flag untuk mencegah deteksi lokasi berulang

function requestNotificationPermission() {
    if (Notification.permission !== 'granted') {
        Notification.requestPermission().then(permission => {
            if (permission !== 'granted') {
                alert('Izin notifikasi diperlukan agar Anda mendapatkan pemberitahuan presensi.');
            }
        });
    }
}

function startCountdown(targetTime) {
    var countdownTimer = setInterval(function() {
        var now = new Date().getTime();
        var distance = targetTime - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown-timer").innerHTML = hours + "h " +
            minutes + "m " + seconds + "s ";

        // Jika countdown selesai
        if (distance < 0) {
            clearInterval(countdownTimer);
            document.getElementById("countdown-timer").innerHTML = "Waktu presensi telah dimulai";

            // Tampilkan notifikasi kepada user
            if (Notification.permission === 'granted') {
                new Notification("Waktunya untuk melakukan presensi!");
            } else {
                alert("Waktunya untuk melakukan presensi!"); // Fallback jika notifikasi tidak diizinkan
            }

            // Tambahkan pesan di halaman selain menggunakan alert
            var presensiNotification = document.createElement("div");
            presensiNotification.innerHTML = "<h4 style='color: green;'>Waktunya untuk melakukan presensi!</h4>";
            presensiNotification.className = "text-center";
            document.querySelector(".countdown-container").appendChild(presensiNotification);
        }
    }, 1000);
}

function resetLocation() {
    document.getElementById("latitude").innerHTML = "";
    document.getElementById("longitude").innerHTML = "";
    document.getElementById("locationName").innerHTML = "Mendeteksi lokasi...";
    locationDetected = false; // Reset flag saat reset lokasi
}

// Fungsi untuk mendapatkan lokasi pengguna
function getLocation() {
    if (locationDetected) return; // Jika lokasi sudah dideteksi, keluar dari fungsi
    resetLocation(); // Reset lokasi saat halaman dimuat

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError, {
            enableHighAccuracy: true, 
            timeout: 5000, 
            maximumAge: 0
        });
    } else {
        document.getElementById("locationName").innerHTML = "Geolocation tidak didukung oleh browser ini.";
    }
}

function getLocationName(latitude, longitude) {
    var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            var address = data.address;
            var jalan = address.road || '';
            var desa = address.village || address.hamlet || address.suburb || '';
            var kecamatan = address.town || address.city_district || address.district || '';
            var kabupaten = address.city || address.county || address.state_district || '';
            var negara = address.country || '';

            // Format alamat lengkap
            var fullAddress = ` ${desa},  ${kabupaten}, ${negara}`;
            document.getElementById("locationName").innerText = fullAddress;
        })
        .catch(error => {
            document.getElementById("locationName").innerText = "Nama lokasi tidak tersedia";
            console.error('Error retrieving location name:', error);
        });
}


function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    document.getElementById("latitude").innerText = latitude;
    document.getElementById("longitude").innerText = longitude;

    // Panggil fungsi geocoding untuk mendapatkan nama lokasi
    getLocationName(latitude, longitude);

    // Tampilkan peta dengan Leaflet.js
    var map = L.map('map').setView([latitude, longitude], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([latitude, longitude]).addTo(map)
        .bindPopup('Lokasi Anda saat ini')
        .openPopup();
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("locationName").innerHTML = "Pengguna menolak permintaan Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("locationName").innerHTML = "Informasi lokasi tidak tersedia.";
            break;
        case error.TIMEOUT:
            document.getElementById("locationName").innerHTML = "Permintaan untuk mendapatkan lokasi pengguna habis waktu.";
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("locationName").innerHTML = "Terjadi kesalahan yang tidak diketahui.";
            break;
    }
    resetLocation();
}

  // Panggil fungsi getLocation saat halaman dimuat
  // Tentukan waktu mulai presensi dari jadwal
  var startTime = "{{ \Carbon\Carbon::parse($start_time)->format('Y-m-d H:i:s') }}";
    var targetTime = new Date(startTime).getTime();

    // Panggil fungsi startCountdown saat halaman dimuat
    window.onload = function() {
    requestNotificationPermission(); // Minta izin notifikasi terlebih dahulu
    if ("{{ $current_date }}" === "{{ $tanggal }}") {
        startCountdown(targetTime);  // Jalankan countdown jika tanggal sesuai
    }
    getLocation();  // Tetap jalankan fungsi getLocation
};


  $('.SavePresensi').click(function(e) {
    var student_id = {{ $getMahasiswa->id }};
    var class_id = {{ $getClass->id }};
    var matkul_id = {{ $getMatkul->id }};
    var week_id = {{ $getDay->id }};
    var dosen_id = "{{$dosen_id  }}";
    var status = "{{ $status }}";
    var presensi_type = $(this).data('value');
    var tgl_presensi = "{{ now()->toDateString() }}";
    var latitude = document.getElementById("latitude").innerText;
    var longitude = document.getElementById("longitude").innerText;

    var expectedLatitude = -7.538284413323129; // Contoh latitude lokasi yang diharapkan
var expectedLongitude = 110.62490576687038; // Contoh longitude lokasi yang diharapkan
var allowedRadius = 100; // Radius yang diizinkan dalam meter


function calculateDistance(lat1, lon1, lat2, lon2) {
    var R = 6371e3; // Radius bumi dalam meter
    var φ1 = lat1 * Math.PI/180;
    var φ2 = lat2 * Math.PI/180;
    var Δφ = (lat2-lat1) * Math.PI/180;
    var Δλ = (lon2-lon1) * Math.PI/180;

    var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ/2) * Math.sin(Δλ/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

    var d = R * c; // Jarak dalam meter
    return d;
}

    if (status === "Offline" && presensi_type === 1) 
        {
    if (!latitude || !longitude) {
        alert("Anda harus menghidupkan GPS untuk melakukan presensi.");
        return;
    }

   
    var distance = calculateDistance(latitude, longitude, expectedLatitude, expectedLongitude);

// Tampilkan jarak dalam bentuk alert
alert("Jarak Anda dari lokasi yang diharapkan: " + distance.toFixed(2) + " meter.");

if (distance > allowedRadius) {
    alert("Anda berada di luar radius yang diizinkan untuk presensi.");
    return;
}
}

    if (presensi_type === 1 || presensi_type === 4 || presensi_type === 5) { // Hanya verifikasi wajah untuk presensi hadir
        document.getElementById('camera-container').style.display = 'block';

        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                video.srcObject = stream;
                video.play();
            }).catch(function() {
                alert("Kamera tidak tersedia di perangkat ini.");
            });
        } else {
            alert("Kamera tidak tersedia di perangkat ini.");
        }

        video.addEventListener('loadeddata', function() {
            // Mengambil gambar dan memverifikasi wajah setelah video dimuat
            context.drawImage(video, 0, 0, 400, 330);
            var dataURL = canvas.toDataURL('image/png');
            verifyFace(dataURL, student_id, presensi_type);
        });

        function verifyFace(imageData, student_id, presensi_type) {
    if (!student_id || !imageData) {
        alert("Data yang dikirim tidak lengkap.");
        return;
    }

    $.ajax({
        type: "POST",
        url: "http://127.0.0.1:5000/compare_faces",
        data: JSON.stringify({
            user_id: student_id,
            uploaded_image: imageData
        }),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            if (response.status === 'success') {
                var face_image_name = response.face_image_name; // Nama file gambar yang dihasilkan API

                $.ajax({
                    type: "POST",
                    url: "{{ url('student/presensi/save') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        student_id: student_id,
                        presensi_type: presensi_type,
                        class_id: class_id,
                        matkul_id: matkul_id,
                        dosen_id:dosen_id,
                        week_id: week_id,
                        tgl_presensi: tgl_presensi,
                        latitude: latitude,
                        longitude: longitude,
                        
                        face_image:face_image_name
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            // alert(response.message); // Handle success message
                            location.reload();
                            window.location.href = "{{ url('student/my_presensi') }}";
                        } else {
                            // alert(response.message); // Handle specific error message
                        location.reload();

                        }
                    },
                    error: function(xhr, status, error) {
                        // alert(xhr.responseJSON.message || "Terjadi kesalahan saat menyimpan presensi."); // Handle specific error message
                        location.reload();
                    }
                });
            } else {
                alert(response.message || "Verifikasi wajah gagal."); // Handle specific error message
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            alert(xhr.responseJSON.message || "Terjadi kesalahan saat memverifikasi wajah."); // Handle specific error message
            location.reload();

        }
    });
}

    }
  });

</script>

<style>
    #map {
        margin-top: 10px;
    }

    .container {
        position: relative;
        display: flex;
    }

    #camera-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000; /* Pastikan kamera berada di atas elemen lainnya */
        background: rgba(0, 0, 0, 0.5); /* Untuk memberikan efek overlay */
    }

    .lat, .long {
        display: none;
    }

    @media screen and (max-width: 768px) {
        .container {
            display: flex;
            flex-direction: column-reverse;
        }
        .info-section {
            order: 1;
        }
        section.content {
            order: 2;
        }
        #map {
            margin: 20px 10px;
        }
    }
</style>

@endsection
