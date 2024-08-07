@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Kelas & Mata Kuliah </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card ">
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Semester</label>
                                        <select name="semester_id"  class="form-control getSemester" required>
                                            <option value="">Select</option>
                                            @foreach ($getSemester as $semester)
                                            <option {{ (Request::get('semester_id') == $semester->id) ? 'selected':'' }}  value="{{ $semester->id }}">{{ $semester->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kelas</label>
                                        <select name="class_id" class="form-control getClass" required>
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Mata Kuliah</label>
                                        <select name="matkul_id" class="form-control getSubject" required>
                                            @if (!empty($getSubject))
                                                @foreach ($getSubject as $matkul)
                                                    <option {{ (Request::get('matkul_id') == $matkul->matkul_id) ? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-success mt-4"
                                            type="submit">Clear</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    @if (!empty(Request::get('class_id')) && !empty(Request::get('matkul_id')))
                        <form id="timetableForm" action="{{ url('admin/class_timetable/add') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="matkul_id" value="{{ Request::get('matkul_id') }}">
                            <input type="hidden" name="semester_id" value="{{ Request::get('semester_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Class TimeTable </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Ruangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Menit Mulai</th>
                                                    <th>Jam Akhir</th>
                                                    <th>Menit Akhir</th>
                                                    <th>Status</th>
                                                    <th>Link Zoom</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($week as $item)
                                                    <tr>
                                                        <th>
                                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $item['week_id'] }}">
                                                            {{ $item['week_name'] }}
                                                        </th>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][room_number]" type="number" style="width: 100px;" class="form-control text-center" id=""
                                                            value="{{ $item['room_number'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][tanggal]" type="date" style="width: 150px;" class="form-control text-center" id=""
                                                            value="{{ $item['tanggal'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][jam_mulai]" max="16" min="7" type="number" style="width: 100px;" class="form-control text-center jam_mulai" data-index="{{ $i }}" value="{{ $item['jam_mulai'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][menit_mulai]" max="60" min="0" type="number" style="width: 100px;" class="form-control text-center menit_mulai" data-index="{{ $i }}" value="{{ $item['menit_mulai'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][jam_akhir]" max="18" min="7" type="number" style="width: 100px;" class="form-control text-center jam_akhir" data-index="{{ $i }}" value="{{ $item['jam_akhir'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][menit_akhir]" max="60" min="0" type="number" style="width: 100px;" class="form-control text-center menit_akhir" data-index="{{ $i }}" value="{{ $item['menit_akhir'] }}">
                                                        </td>
                                                        <td>
                                                            <select name="timetable[{{ $i }}][status]" class="form-control statusSelect" data-index="{{ $i }}">
                                                                <option value="Offline" {{ $item['status'] == 'Offline' ? 'selected' : '' }}>Offline</option>
                                                                <option value="Online" {{ $item['status'] == 'Online' ? 'selected' : '' }}>Online</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <textarea name="timetable[{{ $i }}][link]" class="form-control linkInput" data-index="{{ $i }}" style="display: {{ $item['status'] == 'Online' ? 'block' : 'none' }};">{{ $item['link'] }}</textarea>
                                                        </td>
                                                        <!-- Hidden start_time and end_time inputs -->
                                                        <input  name="timetable[{{ $i }}][start_time]" type="hidden" class="form-control text-center" id="start_time_{{ $i }}" value="">
                                                        <input  name="timetable[{{ $i }}][end_time]" type="hidden" class="form-control text-center" id="end_time_{{ $i }}" value="">
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div style="text-align: center; padding:20px;">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @endif

                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

@endsection

@section('script')

<script type="text/javascript">


$('.getSemester').change(function()
{
    var semester_id = $(this).val();
    $.ajax({
      url: "{{ url('admin/semester_class/get_semester') }}",
      type: "POST",
        data:{
            "_token":"{{ csrf_token() }}",
            semester_id:semester_id,
        },
        dataType:"json",
        success:function(response){
            $('.getClass').html(response.html);
        },
    });
});


$('.getClass').change(function()
{
    var semester_id = $('.getSemester').val();
    var class_id = $('.getClass').val();
     // Log semester_id and class_id
     console.log("Semester ID:", semester_id);
            console.log("Class ID:", class_id);
    $.ajax({
        url:"{{ url('admin/semester_class/get_semester_subject') }}",
        type: "POST",
        data:{
            "_token":"{{ csrf_token() }}",
            semester_id:semester_id,
            class_id:class_id,
        },
        dataType:"json",
        success:function(response){
            $('.getSubject').html(response.html);
        },
    });
});

$('#deleteButton').click(function() {
    if(confirm('Are you sure you want to delete all entries?')) {
        $('#timetableForm').attr('action', '{{ url('admin/class_timetable/delete') }}').submit();
    }
});

$('.statusSelect').change(function() {
    var index = $(this).data('index');
    if ($(this).val() === 'Online') {
        $('.linkInput[data-index="'+index+'"]').show();
    } else {
        $('.linkInput[data-index="'+index+'"]').hide();
    }
});

$('.jam_mulai, .menit_mulai, .jam_akhir, .menit_akhir').on('input', function() {
    var index = $(this).data('index');
    var jam_mulai = $('.jam_mulai[data-index="'+index+'"]').val().padStart(2, '0');
    var menit_mulai = $('.menit_mulai[data-index="'+index+'"]').val().padStart(2, '0');
    var jam_akhir = $('.jam_akhir[data-index="'+index+'"]').val().padStart(2, '0');
    var menit_akhir = $('.menit_akhir[data-index="'+index+'"]').val().padStart(2, '0');
    
    $('#start_time_' + index).val(jam_mulai + ':' + menit_mulai);
    $('#end_time_' + index).val(jam_akhir + ':' + menit_akhir);
});
</script>

@endsection
