@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-center">Presensi Dosen</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        <div class="info-section col-sm-6 ml-4">
            <p>Nama: {{ $getMahasiswa->name }} {{ $getMahasiswa->last_name }}</p>
            <p>Kelas: {{ $getClass->name }}</p>
            <p>Matkul: {{ $getMatkul->name }}</p>
            @foreach($getMyJadwal as $value)
            @foreach($value['week'] as $week)
            @php
            $h = $week['tanggal'];
            $w = $week['start_time'];
            $e = $week['end_time'];
            $r = $week['room_number']
            @endphp
            @endforeach
            @endforeach
            <p>Hari: {{ $getDay->name }} / {{ date('d-m-Y', strtotime($h)) }}</p>
            <p>Jam: {{ date('h:i A', strtotime($w)) }} - {{ date('h:i A', strtotime($e)) }}</p>
            <p>Ruangan: {{ $r }}</p>

            <!-- Menampilkan Lokasi Pengguna -->
            <p>Lokasi Anda saat ini:</p>
            <p id="location">Mendeteksi lokasi...</p>
            <p class="lat">Latitude: <span id="latitude"></span></p>
            <p class="long">Longitude: <span id="longitude"></span></p>
        </div>

        <div id="map" style="height: 300px; width: 100%;"></div>
    </div>

    @include('_message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body p-0">
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
                                    if(!empty($getPresensi->presensi_type) && !empty($getPresensi->created_at && $getDay->id == (now()->dayOfWeek + 1) % 7))
                                    {
                                        $presensi_type = $getPresensi->presensi_type;
                                        $created_at = $getPresensi->created_at;
                                    }

                                    $current_time = \Carbon\Carbon::now()->format('H:i:s');
                                    $class_end_time = \Carbon\Carbon::parse($e)->format('H:i:s');
                                    @endphp
                                       <tr>
                                        @if ($getDay->id != (now()->dayOfWeek + 1) % 7 || $current_time > $class_end_time)
                                        <td></td>
                                        @elseif (!empty($getPresensi->presensi_type))
                                        <td></td>
                                        @else
                                        <td class="text-center">
                                            <button class="SavePresensi btn btn-primary m-2" data-value="1" id="{{ $value->id }}">Hadir</button>
                                            <button class="SavePresensi btn btn-warning m-2" data-value="4" id="{{ $value->id }}">Sakit</button>
                                            <button class="SavePresensi btn btn-danger m-2" data-value="5" id="{{ $value->id }}">Izin</button>
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            @if (!empty($getPresensi->presensi_type))
                                            @if ($presensi_type == 1)
                                            Hadir
                                            @elseif ($presensi_type == 2)
                                            Terlambat A
                                            @elseif ($presensi_type == 3)
                                            Terlambat B
                                            @elseif ($presensi_type == 4)
                                            Sakit
                                            @elseif ($presensi_type == 5)
                                            Izin
                                            @elseif ($presensi_type == 6)
                                            Tidak Hadir
                                            @endif
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
          navigator.geolocation.getCurrentPosition(showPosition, showError);
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
      var dosen_id = {{ $getMahasiswa->id }};
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

      $.ajax({
          type: "POST",
          url: "{{ url('dosen/presensi/save') }}",
          data: {
              '_token': "{{ csrf_token() }}",
              dosen_id: dosen_id,
              presensi_type: presensi_type,
              class_id: class_id,
              matkul_id: matkul_id,
              week_id: week_id,
              tgl_presensi: tgl_presensi,
              latitude: latitude,
              longitude: longitude,
          },
          dataType: "json",
          success: function (data) {
              alert(data.message);
              location.reload();
      window.location.href = "{{ url('dosen/presensi/my_presensi') }}" ;
          },
          error: function (xhr, status, error) {
              console.error(xhr.responseText);
          }
      });
  });
</script>

<style>
  .container {
        display: flex;
    }
    .lat, .long{
      display: none
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
    #map{
      margin: 20px 10px;
    }

}
</style>

@endsection
