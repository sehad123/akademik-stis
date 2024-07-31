@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Papan Pengumuman</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/komunikasi/pengumuman/add') }}" class="btn btn-primary mb-3">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Search Kelas </h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Judul</label>
                                        <input type="text" class="form-control" value="{{ Request::get('judul') }}"
                                            name="judul" placeholder="Enter judul">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Pengumuman To</label>
                                        <input type="date" class="form-control"
                                            value="{{ Request::get('pengumuman_to') }}" name="pengumuman_to"
                                            placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Pengumuman From</label>
                                        <input type="date" class="form-control"
                                            value="{{ Request::get('pengumuman_from') }}" name="pengumuman_from"
                                            placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Publish To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('publish_to') }}"
                                            name="publish_to" placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Publish From</label>
                                        <input type="date" class="form-control"
                                            value="{{ Request::get('publish_from') }}" name="publish_from"
                                            placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/komunikasi/pengumuman') }}" class="btn btn-success mt-4"
                                            type="submit">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('_message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('_message')
                <!-- /.card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Papan Pengumuman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Tanggal Pengumuman</th>
                                            <th>Tanggal Publish</th>
                                            <th>Untuk</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($getRecord as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->tgl_pengumuman)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->tgl_publish)) }}</td>
                                                <td>
                                                    @foreach ($item->getPesan as $pesan)
                                                        @if ($pesan->pesan_to == 2)
                                                            <p>Dosen</p>
                                                        @elseif ($pesan->pesan_to == 3)
                                                            <p>Mahasiswa</p>
                                                        @elseif ($pesan->pesan_to == 4)
                                                            <p>Orang Tua</p>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/komunikasi/pengumuman/edit/' . $item->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('admin/komunikasi/pengumuman/delete/' . $item->id) }}"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Pengumuman tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <div style="padding: 10px; float:right;">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div>
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
