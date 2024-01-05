@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Kelas & Matkul</h1>
                </div>
               
            </div>
        </div><!-- /.container-fluid -->
    </section>

    


    @include('_message')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">

            

                <!-- /.card -->
                <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Class Matkul </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Matkul Name</th>
                                    <th>Matkul Type</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>{{ $value->matkul_name }}</td>
                                    <td>{{ $value->matkul_type }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        {{-- <td>
                                            <a href="{{ url('admin/assign_class_dosen/edit/'. $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/assign_class_dosen/edit_single/'. $value->id) }}" class="btn btn-warning">Edit Single</a>
                                            <a href="{{ url('admin/assign_class_dosen/delete/'. $value->id) }}" class="btn btn-danger">Delete</a>
                                          </td> --}}
                                    </td>
                                </tr>
                                @endforeach
                                    
                            </tbody>
                        </table>
                        <div style="padding: 10px; float:right;">
                        {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                    </div>
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
