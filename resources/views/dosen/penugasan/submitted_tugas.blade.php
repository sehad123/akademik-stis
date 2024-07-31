@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Submitted Tugas</h1>
                </div>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Search Submitted Tugas </h3>
                        </div> --}}
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" value="{{ Request::get('first_name') }}" name="first_name" placeholder="Nama">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Submited From</label>
                                        <input type="date" class="form-control" value="{{ Request::get('deadline_from') }}" name="deadline_from" placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Submited To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('deadline_to') }}" name="deadline_to" placeholder="Enter Date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/tugas/penugasan/submitted/'.$tugas_id) }}" class="btn btn-success mt-4" type="submit">Clear</a>
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
                            <h3 class="card-title">Submitted Tugas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Document</th>
                                            <th>Submited At</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($getRecord as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                                <td>
                                                    @if (!empty($item->getDocument()))
                                                        <a href="{{ $item->getDocument() }}" download="" class="btn btn-warning">Download</a>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y / h:i A', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    @if (!empty($item->description))
                                                        {!! $item->description !!}
                                                    @else
                                                        Tidak ada
                                                    @endif
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
