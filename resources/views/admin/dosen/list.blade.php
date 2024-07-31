@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Dosen (Total: {{ $getRecord->total() }})</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/dosen/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                    <div class="card">
                        
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Nama">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Jenis Kelamin</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option {{ (Request::get('gender') == 'Laki-Laki') ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                                            <option {{ (Request::get('gender') == 'Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                                            <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Asal Domisili</label>
                                        <input type="text" class="form-control" value="{{ Request::get('permanent_address') }}" name="permanent_address" placeholder="Asal Domisili">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Mata Kuliah</label>
                                        <input type="text" class="form-control" value="{{ Request::get('material_status') }}" name="material_status" placeholder="Mata Kuliah">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Tanggal Gabung</label>
                                        <input type="date" class="form-control" value="{{ Request::get('admission_date') }}" name="admission_date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit"> Search</button>
                                        <a href="{{ url('admin/dosen/list') }}" class="btn btn-success mt-4"> Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Gabung</th>
                                            <th>Nomer Hp</th>
                                            <th>Mata Kuliah</th>
                                            <th>Asal Domisili</th>
                                            <th>Status</th>
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
                                                <img src="{{ $value->getProfile() }}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>{{ $value->admission_date }}</td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->material_status }}</td>
                                            <td>{{ $value->permanent_address }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            <td style="min-width: 180px;">
                                                <a href="{{ url('admin/dosen/edit/'. $value->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> 
                                                </a>
                                                <a href="{{ url('admin/dosen/delete/'. $value->id) }}" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </a>
                                                <a href="{{ url('chat?receiver_id=' . base64_encode($value->id)) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-comments"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
