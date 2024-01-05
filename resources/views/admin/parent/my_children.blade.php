@extends('layouts.app')

@section('content')
    


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="card-title"> Parent children List ({{ $getParent->name }} {{ $getParent->last_name }}) </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">add new Parent</a>
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

              <div class="card ">
                <div class="card-header">
                  <h3 class="card-title">Search student </h3>
                </div>
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">

                    <div class="form-group col-md-2">
                      <label >Student ID</label>
                      <input type="text" class="form-control" value="{{ Request::get('id') }}" name="id" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-2">
                      <label >Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group col-md-2">
                      <label >Last Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Enter Last name">
                    </div>
                   
                   
                    <div class="form-group col-md-2">
                      <label >Email</label>
                      <input type="text" class="form-control"  value="{{ Request::get('email') }}" name="email" placeholder="Enter email">
                    </div>
                   
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/parent/my-children/'.$parent_id) }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>

                  </div>
                </form>
              </div>
            

            @include('_message');
            <!-- /.card -->
            @if (!empty($getSearchStudent))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> children List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>profile_pic</th>
                      <th>Student Name</th>
                      <th>Parent Name</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getSearchStudent as $value)
                    <tr>
                     <td>{{ $value->id }}</td>
                     <td>
                       @if (!empty($value->getProfile()))
                       <img src="{{  $value->getProfile()}}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                       @endif
                     </td>
                     <td>{{ $value->name }} {{ $value->last_name }}</td>
                     <td>{{ $value->parent_name }}</td>
                     <td>{{ $value->email }}</td>
                     <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                     <td style="min-width: 150px;">
                       <a href="{{ url('admin/parent/assign_student_parent/'. $value->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm">Tambah sebagai anak</a>
                     </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                {{-- {!! $getRecord->append() !!} --}}
              </div>
              <!-- /.card-body -->
            </div>
            @endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Parent children List  </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>profile_pic</th>
                      <th>Student Name</th>
                      <th>Parent Name</th>
                      <th>Email</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value)
                    <tr>
                     <td>{{ $value->id }}</td>
                     <td>
                       @if (!empty($value->getProfile()))
                       <img src="{{  $value->getProfile()}}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                       @endif
                     </td>
                     <td>{{ $value->name }} {{ $value->last_name }}</td>
                     <td>{{ $value->parent_name }}</td>
                     <td>{{ $value->email }}</td>
                     <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                     <td style="min-width: 150px;">
                       <a href="{{ url('admin/parent/assign_student_parent_delete/'. $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                     </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                {{-- {!! $getRecord->append() !!} --}}
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
