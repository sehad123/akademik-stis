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
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">
              <i class="fas fa-plus"></i>
            </a>
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
          <div class="col-12">
            <!-- general form elements -->
            <div class="card">
            
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3 col-sm-6">
                      <label>Nama</label>
                      <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group col-md-3 col-sm-6">
                      <label>Email</label>
                      <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-3 col-sm-6 mt-4">
                      <button class="btn btn-primary" type="submit">Search</button>
                      <a href="{{ url('admin/admin/list') }}" class="btn btn-success" type="submit">Clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.card -->
          <div class="col-12">
            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $nomer = 1; @endphp
                      @foreach ($getRecord as $value)
                        <tr>
                          <td>{{ $nomer++ }}</td>
                          <td>
                            @if (!empty($value->getProfileDirect()))
                              <img src="{{ $value->getProfileDirect() }}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                            @endif
                          </td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->email }}</td>
                          <td class="text-end">
                            <a href="{{ url('admin/admin/edit/'. $value->id) }}" class="btn btn-primary btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/admin/delete/'. $value->id) }}" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="{{ url('chat?receiver_id=' .base64_encode($value->id)) }}" class="btn btn-success btn-sm">
                              <i class="fas fa-comments"></i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-end p-3">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
