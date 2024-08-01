@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Presensi Dosen </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Kelas</label>
                      <select id="getClass" name="class_id" class="form-control getClass" required>
                          <option value="">Select</option>
                          @foreach ($getClass as $class)
                              <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-3">
                      <label>Mata Kuliah</label>
                      <select id="getMatkul" name="matkul_id" class="form-control getSubject" required>
                          <option value="">Select</option>
                          @if (!empty($getSubject))
                              @foreach ($getSubject as $matkul)
                                  <option {{ (Request::get('matkul_id') == $matkul->matkul_id) ? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                              @endforeach
                          @endif
                      </select>
                  </div>

                    <div class="form-group col-md-3">
                      <label >Tanggal Presensi </label>
                      <input type="date" id="getPresensiDate" value="{{ Request::get('tgl_presensi') }}" name="tgl_presensi" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/presensi/dosen') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          @if (!empty(Request::get('class_id')) && !empty(Request::get('tgl_presensi')) && !empty(Request::get('matkul_id')) ) 
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Presensi Dosen</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dosen</th>
                            <th>Presensi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($getDosen) && !empty($getDosen->count()))
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($getDosen as $value)
                        @php
                        $presensi_type = '';
                            $getPresensi = $value->getPresensi($value->id,Request::get('class_id'),Request::get('tgl_presensi'),Request::get('matkul_id'));
                            if(!empty($getPresensi->presensi_type))
                            {
                                $presensi_type = $getPresensi->presensi_type;
                            }
                        @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <button class="SavePresensi btn btn-primary m-2" data-value="1" id="{{ $value->id }}">Hadir</button>
                                    <button class="SavePresensi btn btn-warning m-2" data-value="2" id="{{ $value->id }}">Terlambat</button>
                                    <button class="SavePresensi btn btn-danger m-2" data-value="3" id="{{ $value->id }}">Sakit</button>
                                    <button class="SavePresensi btn btn-success m-2" data-value="4" id="{{ $value->id }}">Izin</button>
                                    <button class="SavePresensi btn btn-secondary m-2" data-value="5" id="{{ $value->id }}">Tidak Hadir</button>
                                </td>
                                <td id="status{{ $value->id }}">
                                    @switch($presensi_type)
                                        @case(1)
                                            Hadir
                                            @break
                                        @case(2)
                                            Terlambat
                                            @break
                                        @case(3)
                                            Sakit
                                            @break
                                        @case(4)
                                            Izin
                                            @break
                                        @case(5)
                                            Tidak Hadir
                                            @break
                                        @default
                                            -
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                        <tr></tr>
                        @endif
                    </tbody>
                  </table>
          </div>
            </div>
          @endif
        </div>
    </div>

    </section>
  </div>

@endsection

@section('script')

<script type="text/javascript">
$('#getClass').change(function()
{
    var class_id = $(this).val();
    $.ajax({
        url:"{{ url('admin/presensi/get_subject') }}",
        type: "POST",
        data:{
            "_token":"{{ csrf_token() }}",
            class_id:class_id,
        },
        dataType:"json",
        success:function(response){
            $('.getSubject').html(response.html);
        },
    });
});

$('.SavePresensi').click(function(e) {
    var dosen_id = $(this).attr('id');
    var presensi_type = $(this).data('value');
    var class_id = $('#getClass').val();
    var matkul_id = $('#getMatkul').val();
    var tgl_presensi = $('#getPresensiDate').val();

    $.ajax({
        type: "POST",
        url: "{{ url('admin/presensi/dosen/save') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            dosen_id: dosen_id,
            presensi_type: presensi_type,
            class_id: class_id,
            matkul_id: matkul_id,
            tgl_presensi: tgl_presensi,
        },
        dataType: "json",
        success: function(data) {
            alert(data.message);
            $('#status' + dosen_id).text(data.presensi_status);
            location.reload();

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

</script>

@endsection
