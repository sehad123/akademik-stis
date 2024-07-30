@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Mata Kuliah ({{ $getUser->name }} {{ $getUser->last_name }})</h1>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                 
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mata Kuliah</th>
                                    <th>Type</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @foreach ($getRecord as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->matkul_name }}</td>
                                        <td>{{ $item->matkul_type }}</td>
                                        <td>
                                            <a href="{{ url('ortu/my_student/subject/class_timetable/'. $item->class_id.'/'.$item->matkul_id.'/'.$getUser->id) }}" class="btn btn-primary"> Jadwal</a>
                                            
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
