@extends('layouts.app')

@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tugas Tersubmit</h1>
                </div>
            </div>

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Search My Submitted Tugas</h3>
                    </div> --}}
                    <form method="get" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Kelas">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Mata Kuliah</label>
                                    <input type="text" class="form-control" value="{{ Request::get('matkul_name') }}" name="matkul_name" placeholder="Mata Kuliah">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary mt-4" type="submit">
                                         Search
                                    </button>
                                    <a href="{{ url('student/my_submited_tugas') }}" class="btn btn-success mt-4" type="submit">
                                         Clear
                                    </a>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Tugas Anda</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Tanggal</th>
                                            <th>Deadline</th>
                                            <th>Document</th>
                                            <th>Deskripsi</th>
                                            <th>Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($getRecord as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->class_name }}</td>
                                                <td>{{ $item->matkul_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->getTugas->tanggal)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->getTugas->deadline)) }}</td>
                                                <td>
                                                    @if (!empty($item->getDocument()))
                                                        <a href="{{ $item->getDocument() }}" download="" class="btn btn-warning">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{!! $item->description !!}</td>
                                                <td>{{ date('d-m-Y / h:i A', strtotime($item->created_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">Belum ada Tugas tersubmit saat ini</td>
                                            </tr>
                                        @endforelse
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
