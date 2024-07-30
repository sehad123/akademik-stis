@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Presensi Mahasiswa </h1>
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
              <div class="card-header">
                <h3 class="card-title">Search Presensi </h3>
              </div>
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
                      <a href="{{ url('admin/presensi/student') }}" class="btn btn-success mt-4" type="submit">clear</a>
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
                  <h3 class="card-title">Daftar Presensi Mahasiswa</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Mahasiswa</th>
                            <th>Presensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($getStudent) && !empty($getStudent->count()))
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($getStudent as $value)
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
                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                <td>
                                    <label style="margin-right: 10px;">
                                        <input value="1" {{ ($presensi_type == '1') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}"  type="radio" name="presensi{{ $value->id }}"> Hadir
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input value="2" {{ ($presensi_type == '2') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}"type="radio" name="presensi{{ $value->id }}"> Terlambat
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input value="3" {{ ($presensi_type == '3') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Sakit
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input value="4" {{ ($presensi_type == '4') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Izin
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input value="5" {{ ($presensi_type == '5') ? 'checked' :'' }} class="SavePresensi" id="{{ $value->id }}" type="radio" name="presensi{{ $value->id }}"> Tidak Hadir
                                    </label>
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

    $('.SavePresensi').change(function(e) {
    var student_id = $(this).attr('id');
    var presensi_type = $(this).val();
    var class_id = $('#getClass').val()
    var matkul_id = $('#getMatkul').val()
    var tgl_presensi = $('#getPresensiDate').val()

    $.ajax({
        type: "POST",
        url: "{{ url('admin/presensi/student/save') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            student_id: student_id,
            presensi_type: presensi_type,
            class_id:class_id,
            matkul_id:matkul_id,
            tgl_presensi:tgl_presensi,
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