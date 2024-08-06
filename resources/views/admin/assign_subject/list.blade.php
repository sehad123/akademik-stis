@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Kelas & Mata Kuliah</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/assign_subject/add') }}" class="btn btn-primary">+</a>
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
                                        <label> Kelas</label>
                                        <input type="text" class="form-control" value="{{ Request::get('class_name') }}"
                                            name="class_name" placeholder="Kelas">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label> Mata Kuliah</label>
                                        <input type="text" class="form-control" value="{{ Request::get('matkul_name') }}"
                                            name="matkul_name" placeholder="Mata Kuliah">
                                    </div>
                                   
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success mt-4"
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
                   
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelas</th>
                                    <th>Mata Kuliah</th>
                                    <th>Status</th>
                                    {{-- <th>Created By</th> --}}
                                    {{-- <th>Created Date</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                            @endphp
                                @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>{{ $value->matkul_name }}</td>
                                    <td>
                                        @if( $value->status == 0)
                                        Active
                                        @else
                                        Inactive
                                        @endif
                                    </td>
                                    </td>
                                        <td>
                                            <a href="{{ url('admin/assign_subject/edit/'. $value->id) }}" class="btn btn-primary">
                              <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- <a href="{{ url('admin/assign_subject/edit_single/'. $value->id) }}" class="btn btn-warning">Edit Single</a> --}}
                                            <a href="{{ url('admin/assign_subject/delete/'. $value->id) }}" class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                                            </a>
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
