@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Matkul Dosen ({{ $getRecord->total() }})</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/assign_class_dosen/add') }}" class="btn btn-primary">add new Dosen Matkul</a>
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
                        <div class="card-header">
                            <h3 class="card-title">Search Assign Matkul </h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Dosen Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('dosen_name') }}"
                                            name="dosen_name" placeholder="Dosen name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Matkul Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('matkul_name') }}"
                                            name="matkul_name" placeholder="Matkul name">
                                    </div>
                                   
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}"
                                            name="date" placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/assign_class_dosen/list') }}" class="btn btn-success mt-4"
                                            type="submit">clear</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

                <!-- /.card -->
                <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Matkul List </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Matkul Name</th>
                                    <th>Dosen Name</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $value->matkul_name }}</td>
                                    <td>{{ $value->dosen_name }} </td>
                                    <td>
                                        @if( $value->status == 0)
                                        Active
                                        @else
                                        Inactive
                                        @endif
                                    </td>
                                    </td>
                                    <td>{{ $value->created_by_name }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/assign_class_dosen/edit/'. $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ url('admin/assign_class_dosen/edit_single/'. $value->id) }}" class="btn btn-warning">Edit Single</a>
                                            <a href="{{ url('admin/assign_class_dosen/delete/'. $value->id) }}" class="btn btn-danger">Delete</a>
                                          </td>
                                    </td>
                                </tr>
                                @endforeach
                                    
                            </tbody>
                        </table>
                        <div style="padding: 10px; float:right;">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
