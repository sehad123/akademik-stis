@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Class Timetable </h1>
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
                                        <label>Class Name</label>
                                        <select name="class_id" class="form-control getClass" required>
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Matkul Name</label>
                                        <select name="matkul_id" class="form-control getSubject" required>
                                            <option value="">Select</option>
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
                        <form action="{{ url('admin/class_timetable/add') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="matkul_id" value="{{ Request::get('matkul_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Class TimeTable </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Week</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Ruangan</th>
                                                <th>Tanggal</th>
                                                <th>Jam Mulai</th>
                                                <th>Menit Mulai</th>
                                                <th>Jam Akhir</th>
                                                <th>Menit Akhir</th>
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
                                                        <input  name="timetable[{{ $i }}][start_time]" type="time" class="form-control text-center" id=""
                                                        value="{{ $item['start_time'] }}">
                                                        

                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][end_time]" type="time" class="form-control text-center" id=""
                                                        value="{{ $item['end_time'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][room_number]" type="number" style="width: 100px;" class="form-control text-center" id=""
                                                        value="{{ $item['room_number'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][tanggal]" type="date" style="width: 150px;" class="form-control text-center" id=""
                                                        value="{{ $item['tanggal'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][jam_mulai]" max="16" min="7" type="number" style="width: 100px;" class="form-control text-center" id=""
                                                        value="{{ $item['jam_mulai'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][menit_mulai]" max="60" min="0" type="number" style="width: 100px;" class="form-control text-center" id=""
                                                        value="{{ $item['menit_mulai'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][jam_akhir]"  max="18" min="7"  type="number" style="width: 100px;" class="form-control text-center" id=""
                                                        value="{{ $item['jam_akhir'] }}">
                                                    </td>
                                                    <td>
                                                        <input  name="timetable[{{ $i }}][menit_akhir]"max="60" min="0" type="number" style="width: 100px;" class="form-control text-center" id=""
                                                        value="{{ $item['menit_akhir'] }}">
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div style="text-align: center; padding:20px;">
                                        <button class="btn btn-primary">Submit</button>
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
$('.getClass').change(function()
{
    var class_id = $(this).val();
    $.ajax({
        url:"{{ url('admin/class_timetable/get_subject') }}",
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
</script>

@endsection
