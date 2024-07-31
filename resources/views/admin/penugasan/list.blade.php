@extends('layouts.app')

@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tugas</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/tugas/penugasan/add') }}" class="btn btn-primary">+</a>
          </div>
        
          <div class="col-md-12">
            
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Search Tugas </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                  <div class="form-group col-md-3">
                    <label >Class</label>
                    <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Enter class_name">
                  </div>
                  <div class="form-group col-md-3">
                    <label >Matkul</label>
                    <input type="text" class="form-control"  value="{{ Request::get('matkul_name') }}" name="matkul_name" placeholder="Enter matkul_name">
                  </div>
                
                <div class="form-group col-md-3">
                    <label> deadline From</label>
                    <input type="date" class="form-control" value="{{ Request::get('deadline_from') }}"
                        name="deadline_from" placeholder="Enter Date">
                </div>
                <div class="form-group col-md-3">
                  <label> deadline To</label>
                  <input type="date" class="form-control" value="{{ Request::get('deadline_to') }}"
                      name="deadline_to" placeholder="Enter Date">
              </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary mt-4" type="submit">Search</button>
                    <a href="{{ url('admin/tugas/penugasan') }}" class="btn btn-success mt-4" type="submit">clear</a>
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
                <h3 class="card-title">Tugas Mahasiswa </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Class</th>
                      <th>Matkul</th>
                      <th>Tanggal </th>
                      <th>Deadline </th>
                      <th>Document </th>
                      <th>Deskripsi</th>
                      <th>Created By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
             <tbody>
              @php
                  $i= 1;
              @endphp
              @foreach ($getRecord as $item)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->class_name }}</td>
                <td>{{ $item->matkul_name }}</td>
                <td>{{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                <td>{{ date('d-m-Y',strtotime($item->deadline)) }}</td>
                <td>
                  @if (!empty($item->getDocument()))
                      <a href="{{ $item->getDocument() }}" download="" class="btn btn-primary">Download</a>
                  @endif
                </td>
                <td>{!! $item->description !!}</td>
                <td>{{ $item->created_name }}</td>
                <td>
                  <a href="{{ url('admin/tugas/penugasan/edit/'. $item->id) }}" class="btn btn-primary">Edit</a>
                  <a href="{{ url('admin/tugas/penugasan/delete/'. $item->id) }}" class="btn btn-danger">Delete</a>
                  <a href="{{ url('admin/tugas/penugasan/submitted/'. $item->id) }}" class="btn btn-success">Submitted Homework</a>
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
