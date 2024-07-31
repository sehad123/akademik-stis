@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="card-title">Data Anak</h1>
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
                    <div class="card">
                        <div class="card-header">
                            <!-- Optional header content -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile </th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>NIM</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor HP</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $nomer = 1;
                                        @endphp
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $nomer++ }}</td>
                                                <td>
                                                    @if (!empty($value->getProfile()))
                                                        <img src="{{ $value->getProfile() }}" style="width: 50px; height: 50px; border-radius: 50%;" alt="Profile Picture">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->admission_number }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td style="width: 250px;">
                                                    <a href="{{ url('ortu/my_student/subject/'.$value->id) }}" class="btn btn-success btn-sm mb-1">
                                                        <i class="fas fa-book"></i> Matkul
                                                    </a>
                                                    <a href="{{ url('ortu/my_student/exam_student/'.$value->id) }}" class="btn btn-primary btn-sm mb-1">
                                                        <i class="fas fa-calendar-check"></i> Jadwal Ujian
                                                    </a>
                                                    <a href="{{ url('ortu/my_student/calendar/'.$value->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-calendar-alt"></i> Calendar
                                                    </a>
                                                    <a href="{{ url('ortu/my_student/exam_result/'.$value->id) }}" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-graduation-cap"></i> Nilai
                                                    </a>
                                                    <a href="{{ url('chat?receiver_id=' . base64_encode($value->id)) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-comments"></i> Chat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float: right;"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
