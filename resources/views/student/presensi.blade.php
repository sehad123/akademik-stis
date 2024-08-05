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
            if (!empty($getMyJadwal)) {
                $week = $getMyJadwal[0]['week'][0];
                $tanggal = $week['tanggal'];
                $start_time = $week['start_time'];
                $end_time = $week['end_time'];
                $room_number = $week['room_number'];
                $status = $week['status'];
                $link = $week['link'];
            }
            @endphp

            <p>Hari: {{ $getDay->name }} / {{ date('d-m-Y', strtotime($tanggal)) }}</p>
            <p>Jam: {{ date('h:i A', strtotime($start_time)) }} - {{ date('h:i A', strtotime($end_time)) }}</p>
            <p>Ruangan: {{ $room_number }}</p>
            <p>Status: {{ $status }}</p>
            @if ($status === "Online")
            <p>Link Zoom: <a href="{{ $link }}"> {{ $link }}</a></p>
            @else
            <p></p>                
            @endif

            <!-- Menampilkan Lokasi Pengguna -->
            <p>Lokasi Anda saat ini:</p>
            <p id="location">Mendeteksi lokasi...</p>
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

                            @if ($current_time >= $class_start_time && $current_time <= $class_end_time)
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
  // Fungsi untuk mereset lokasi
  function resetLocation() {
      document.getElementById("latitude").innerHTML = "";
      document.getElementById("longitude").innerHTML = "";
      document.getElementById("location").innerHTML = "Mendeteksi lokasi...";
  }

  // Fungsi untuk mendapatkan lokasi pengguna
  function getLocation() {
      resetLocation(); // Reset lokasi saat halaman dimuat

      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError, {
              enableHighAccuracy: true, 
              timeout: 5000, 
              maximumAge: 0
          });
      } else {
          document.getElementById("location").innerHTML = "Geolocation tidak didukung oleh browser ini.";
      }
  }

  function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      document.getElementById("latitude").innerHTML = latitude;
      document.getElementById("longitude").innerHTML = longitude;
      document.getElementById("location").innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;

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
              document.getElementById("location").innerHTML = "Pengguna menolak permintaan Geolocation.";
              break;
          case error.POSITION_UNAVAILABLE:
              document.getElementById("location").innerHTML = "Informasi lokasi tidak tersedia.";
              break;
          case error.TIMEOUT:
              document.getElementById("location").innerHTML = "Permintaan untuk mendapatkan lokasi pengguna habis waktu.";
              break;
          case error.UNKNOWN_ERROR:
              document.getElementById("location").innerHTML = "Terjadi kesalahan yang tidak diketahui.";
              break;
      }
      resetLocation();
  }

  // Panggil fungsi getLocation saat halaman dimuat
  window.onload = getLocation;

  $('.SavePresensi').click(function(e) {
    var student_id = {{ $getMahasiswa->id }};
    var class_id = {{ $getClass->id }};
    var matkul_id = {{ $getMatkul->id }};
    var week_id = {{ $getDay->id }};
    var presensi_type = $(this).data('value');
    var tgl_presensi = "{{ now()->toDateString() }}";
    var latitude = document.getElementById("latitude").innerText;
    var longitude = document.getElementById("longitude").innerText;

    if (!latitude || !longitude) {
        alert("Anda harus menghidupkan GPS untuk melakukan presensi.");
        return;
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
                $.ajax({
                    type: "POST",
                    url: "{{ url('student/presensi/save') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        student_id: student_id,
                        presensi_type: presensi_type,
                        class_id: class_id,
                        matkul_id: matkul_id,
                        week_id: week_id,
                        tgl_presensi: tgl_presensi,
                        latitude: latitude,
                        longitude: longitude
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
