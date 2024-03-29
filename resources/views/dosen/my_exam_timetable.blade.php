@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Ujian Mahasiswa </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                @include('_message')
                    @foreach ($getRecord as $value)
                        <h2>{{ $value['matkul_name'] }}</h2>
                            @foreach ($value['exam'] as $exam)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $exam['exam_name'] }} </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Matkul Name</th>
                                                <th>Hari</th>
                                                <th>Tanggal </th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Ruangan</th>
                                                <th>Nilai KKM</th>
                                                <th>Nilai Max</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($exam['matkul'] as $valueW)
                                            <tr>
                                                <td> {{ $valueW['matkul_name'] }}</td>
                                                <td> {{date('l',strtotime( $valueW['exam_date'])) }}</td>
                                                <td> {{date('d-m-Y',strtotime( $valueW['exam_date'])) }}</td>
                                                <td>{{ !empty($valueW['start_time'])? date('h:i A', strtotime($valueW['start_time'])):'' }}</td>
                                                <td>{{ !empty($valueW['end_time'])? date('h:i A', strtotime($valueW['end_time'])):'' }}</td>
                                                <td> {{ $valueW['room_number'] }}</td>
                                                <td> {{ $valueW['passing_mark'] }}</td>
                                                <td> {{ $valueW['full_mark'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                    @endforeach


                </div>

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
