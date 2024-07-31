@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Materi</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('dosen/tugas/materi/add') }}" class="btn btn-primary mb-2">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Search Materi </h3>
                    </div> --}}
                    <form method="get" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder=" Kelas">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Mata Kuliah</label>
                                    <input type="text" class="form-control" value="{{ Request::get('matkul_name') }}" name="matkul_name" placeholder=" Mata Kuliah">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary mt-4" type="submit">Search</button>
                                    <a href="{{ url('dosen/tugas/materi') }}" class="btn btn-success mt-4" type="submit">Clear</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Materi Mahasiswa</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Tanggal</th>
                                            <th>Document</th>
                                            <th>Deskripsi</th>
                                            {{-- <th>Created By</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($getRecord as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->class_name }}</td>
                                                <td>{{ $item->matkul_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                                <td>
                                                    @if (!empty($item->getDocument()))
                                                        <a href="{{ $item->getDocument() }}" download="" class="btn btn-primary">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{!! $item->description !!}</td>
                                                {{-- <td>{{ $item->created_name }}</td> --}}
                                                <td>
                                                    <a href="{{ url('dosen/tugas/materi/edit/'. $item->id) }}" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url('dosen/tugas/materi/delete/'. $item->id) }}" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float:right;"></div>
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
