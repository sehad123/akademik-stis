@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-right">Presensi Dosen </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="col-sm-6 ml-4">
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
<p>Hari : {{ $getDay->name }} / {{$h  }} </p>
      <p>jam : {{ date('h:i A',strtotime($w)) }} - {{ date('h:i A',strtotime($e)) }} </p>
      <p>Ruangan : {{ $r }} </p>


    </div>

    @include('_message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
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
                        $getPresensi = $value->getPresensi($getMahasiswa->id, $getClass->id, now()->toDateString(), $getMatkul->id,$getDay->id);
                            if(!empty($getPresensi->presensi_type) && !empty($getPresensi->created_at && $getDay->id == (now()->dayOfWeek + 1) % 7))
                            {
                              // echo '<script>alert("Anda sudah melakukan presensi");</script>';
                                $presensi_type = $getPresensi->presensi_type;
                                $created_at = $getPresensi->created_at;
                            }
                        @endphp
                        @endforeach
                        <tr>
                              @if ($getDay->id != (now()->dayOfWeek + 1) % 7)
                              <td></td>
                              @elseif (!empty($getPresensi->presensi_type))
                              <td></td>
                                @else
                                <td class="text-center">
                                  <label style="margin-right: 10px;">
                                      <input value="1" {{ ($presensi_type == '1') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}"  type="radio" name="presensi{{ $value->id }}"> Hadir
                                  </label>
                                  {{-- <label style="margin-right: 10px;">
                                      <input value="2" {{ ($presensi_type == '2') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}"type="radio" name="presensi{{ $value->id }}"> Terlambat
                                  </label> --}}
                                  <label style="margin-right: 10px;">
                                      <input value="3" {{ ($presensi_type == '3') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Sakit
                                  </label>
                                  <label style="margin-right: 10px;">
                                      <input value="4" {{ ($presensi_type == '4') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Izin
                                  </label>
                                  {{-- <label style="margin-right: 10px;">
                                      <input value="5" {{ ($presensi_type == '5') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Tidak Hadir
                                  </label> --}}
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
                                  Anda Presensi pada =  {{ date('d-m-Y / H:i A ',strtotime($created_at)) }}
                                  @else
                                  Jam Presensi anda = {{ " " }}
                                  @endif
                                </td>
                              </tr>
                    </tbody>
                  </table>
          </div>
            </div>
        </div>
    </div>

    </section>
  </div>

@endsection

@section('script')

<script type="text/javascript">

    $('.SavePresensi').change(function(e) {
      var student_id = {{ Auth::user()->id  }}; // replace with the actual variable that holds the student_id
    var class_id = {{ $getClass->id  }}; // replace with the actual variable that holds the class_id
    var matkul_id = {{ $getMatkul->id }}; // replace with the actual variable that holds the matkul_id
    var week_id = {{ $getDay->id }}; // replace with the actual variable that holds the matkul_id
    var presensi_type = $(this).val();
    var tgl_presensi = {{ now()->toDateString() }}

    $.ajax({
        type: "POST",
        url: "{{ url('dosen/presensi/save') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            student_id: student_id,
            presensi_type: presensi_type,
            class_id:class_id,
            matkul_id:matkul_id,
            week_id:week_id,
            tgl_presensi: tgl_presensi, // Assuming you want the current date
        },
        dataType: "json",
        success: function(data) {
            alert(data.message);
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

</script>

    
@endsection