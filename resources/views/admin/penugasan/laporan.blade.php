@extends('layouts.app')

@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Tugas</h1>
          </div>
       
          <div class="col-md-12">
            
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Search Laporan Tugas </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-3">
                        <label >Class </label>
                        <input type="text" class="form-control"  value="{{ Request::get('class_name') }}" name="class_name" placeholder="Enter class_name">
                      </div>
                      <div class="form-group col-md-3">
                        <label >Matkul </label>
                        <input type="text" class="form-control"  value="{{ Request::get('matkul_name') }}" name="matkul_name" placeholder="Enter matkul_name">
                      </div>

                <div class="form-group col-md-3">
                    <label> Submited From</label>
                    <input type="date" class="form-control" value="{{ Request::get('deadline_from') }}"
                        name="deadline_from" placeholder="Enter Date">
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
            @include('_message');
            <!-- /.card -->
            <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Submitted Tugas </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Mahasiswa</th>
                      <th>Class </th>
                      <th>Matkul </th>
                      <th>Tugas Date </th>
                      <th>Submited At</th>
                      <th>Deskripsi</th>
                      <th>Document </th>
                    </tr>
                  </thead>
             <tbody>
              @php
                  $i= 1;
              @endphp
              @foreach ($getRecord as $item)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                <td>{{ $item->class_name }}</td>
                <td>{{ $item->matkul_name }}</td>
                <td>{{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                
                <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                @if (empty($getRecord->description) || ($getRecord->description == null))
                    <td>Tidak ada</td>
                    @else
                    <td>{!! $item->description !!}</td>
                    @endif
                    <td>
                        @if (!empty($item->getDocument()))
                            <a href="{{ $item->getDocument() }}" download="" class="btn btn-warning">Download</a>
                        @endif
                      </td>
              </tr>
              @endforeach
             </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
