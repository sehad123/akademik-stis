@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Ujian ({{ $getStudent->name }} {{ $getStudent->last_name }}) </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @include('_message')
                    @foreach ($getRecord as $value)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $value['name'] }} </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Matkul Name</th>
                                                <th>Tanggal </th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Ruangan</th>
                                                <th>Nilai KKM</th>
                                                <th>Nilai Max</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($value['exam'] as $valueW)
                                            <tr>
                                                <td> {{ $valueW['matkul_name'] }}</td>
                                                <td>{{ (new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE))->format(strtotime($valueW['exam_date'])) }}</td>
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
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
</div>

@endsection