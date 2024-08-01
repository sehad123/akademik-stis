@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-center">Presensi Mahasiswa </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container">
      <div class="info-section col-sm-6 ml-4" style="flex">
        <p>Nama : {{ $getMahasiswa->name }} {{ $getMahasiswa->last_name }}</p>
                <p>Kelas : {{ $getClass->name }}</p>
                <p>Matkul : {{ $getMatkul->name }}</p>
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
                <p>Hari : {{ $getDay->name }} / {{ date('d-m-Y', strtotime($h)) }}</p>
                <p>jam : {{ date('h:i A', strtotime($w)) }} - {{ date('h:i A', strtotime($e)) }}</p>
                <p>Ruangan : {{ $r }}</p>

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
                                        <th class="text-center">status</th>
                                        <th class="text-center">keterangan</th>
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
                                    @endphp
                                    <tr>
                                        @if ($getDay->id != (now()->dayOfWeek + 1) % 7)
                                        <td></td>
                                        @elseif (!empty($getPresensi->presensi_type))
                                        <td></td>
                                        @else
                                        <td class="text-center">
                                            <label style="margin-right: 10px;">
                                                <input value="1" {{ ($presensi_type == '1') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Hadir
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="3" {{ ($presensi_type == '4') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Sakit
                                            </label>
                                            <label style="margin-right: 10px;">
                                                <input value="4" {{ ($presensi_type == '5') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Izin
                                            </label>
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
    // Fungsi untuk mendapatkan lokasi pengguna
    function getLocation() {
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
                document.getElementById("location").innerHTML = "Pengguna menolak permintaan Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                document.getElementById("location").innerHTML = "Informasi lokasi tidak tersedia."
                break;
            case error.TIMEOUT:
                document.getElementById("location").innerHTML = "Permintaan untuk mendapatkan lokasi pengguna habis waktu."
                break;
            case error.UNKNOWN_ERROR:
                document.getElementById("location").innerHTML = "Terjadi kesalahan yang tidak diketahui."
                break;
        }
    }

    // Panggil fungsi getLocation saat halaman dimuat
    window.onload = getLocation;

    $('.SavePresensi').change(function(e) {
        var student_id = {{ $getMahasiswa->id }};
        var class_id = {{ $getClass->id }};
        var matkul_id = {{ $getMatkul->id }};
        var week_id = {{ $getDay->id }};
        var presensi_type = $(this).val();
        var tgl_presensi = "{{ now()->toDateString() }}";
        var latitude = document.getElementById("latitude").innerText;
        var longitude = document.getElementById("longitude").innerText;

        if (!latitude || !longitude) {
            alert("Anda harus menghidupkan GPS untuk melakukan presensi.");
            return;
        }

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
                longitude: longitude,
            },
            dataType: "json",
            success: function (data) {
                alert(data.message);
                location.reload();
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
