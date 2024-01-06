@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal My Children  ({{ $getClass->name }} - {{ $getMatkul->name }}) <span style="color: blue">({{ $getStudent->name }})</span> </h1>
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
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $getClass->name }} - {{ $getMatkul->name }}  </h3>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($getRecord as $valueW)
                                                <tr>
                                                    <td>{{ $valueW['week_name'] }}</td>
                                                    <td>{{ !empty($valueW['start_time'])? date('h:i A', strtotime($valueW['start_time'])):'' }}</td>
                                                    <td>{{ !empty($valueW['end_time'])? date('h:i A', strtotime($valueW['end_time'])):'' }}</td>
                                                    <td>{{ $valueW['room_number'] }}</td>
                                                </tr>
                                            @endforeach
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>


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


