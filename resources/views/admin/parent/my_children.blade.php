@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="card-title"> Data Orang Tua ({{ $getParent->name }} {{ $getParent->last_name }}) </h1>
                </div>
            </div>
        </div>
    </section>

    @include('_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Search Mahasiswa</h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Nama">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/parent/my-children/'.$parent_id) }}" class="btn btn-success mt-4">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('_message')
                    <!-- /.card -->
                    @if (!empty($getSearchStudent))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Children List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Orang Tua</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getSearchStudent as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if (!empty($value->getProfile()))
                                                <img src="{{ $value->getProfile() }}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->parent_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ url('admin/parent/assign_student_parent/'. $value->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-user-plus"></i> Tambah sebagai anak
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Mahasiswa Orang Tua</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Orang Tua</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if (!empty($value->getProfile()))
                                                <img src="{{ $value->getProfile() }}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->parent_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ url('admin/parent/assign_student_parent_delete/'. $value->id) }}" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@endsection
