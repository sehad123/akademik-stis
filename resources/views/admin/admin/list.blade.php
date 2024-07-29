@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Admin ( Total : {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Tambah Admin</a>
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
                    <h3 class="card-title">Search Admin </h3>
                  </div>
                  <form method="get" action="">
                    <div class="card-body">
                      <div class="row">

                      <div class="form-group col-md-3">
                        <label >Name</label>
                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Enter name">
                      </div>
                      <div class="form-group col-md-3">
                        <label >Email</label>
                        <input type="text" class="form-control"  value="{{ Request::get('email') }}" name="email" placeholder="Enter email">
                      </div>
                      {{-- <div class="form-group col-md-3">
                        <label >Date</label>
                        <input type="date" class="form-control"  value="{{ Request::get('date') }}" name="date" placeholder="Enter date">
                      </div> --}}
                      <div class="form-group col-md-3">
                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                        <a href="{{ url('admin/admin/list') }}" class="btn btn-success mt-4" type="submit">clear</a>
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
                <h3 class="card-title">Admin List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Email</th>
                      {{-- <th>Created Date</th> --}}
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
                      @if (!empty($value->getProfileDirect()))
                      <img src="{{  $value->getProfileDirect()}}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                      @endif
                    </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        {{-- <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td> --}}
                        <td>
                          <a href="{{ url('admin/admin/edit/'. $value->id) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ url('admin/admin/delete/'. $value->id) }}" class="btn btn-danger">Delete</a>
                          <a href="{{ url('chat?receiver_id=' .base64_encode($value->id)) }}" class="btn btn-success">Chat</a>
                        </td>
                       </tr>
                   @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
