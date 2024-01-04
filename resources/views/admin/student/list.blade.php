@extends('layouts.app')

@section('content')
    


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student List ( Total : {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/student/add') }}" class="btn btn-primary">add new Student</a>
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
            
               
              
             
            </div>
            
            @include('_message');
            <!-- /.card -->
            <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>profile_pic</th>
                      <th>Name</th>
                      <th>Email</th>
                      {{-- <th>Admission Number</th> --}}
                      {{-- <th>Roll Number</th> --}}
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Tanggal Lahir</th>
                      <th>Religion</th>
                      <th>Nomer Hp</th>
                      {{-- <th>Admission Date</th> --}}
                      <th>Golongan Darah</th>
                      <th>Tinggi Badan</th>
                      <th>Berat Badan</th>
                      <th>Status</th>
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
                        <td>{{ $value->email }}</td>
                        {{-- <td>{{ $value->admission_number }}</td> --}}
                        {{-- <td>{{ $value->roll_number }}</td> --}}
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>
                           
                          @if(!empty($value->date_of_birth ))
                              {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @endif
                        </td>
                        <td>{{ $value->religion }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        {{-- <td>{{ $value->admission_date }}</td> --}}
                        {{-- <td>
                           
                          @if(!empty($value->admission_date ))
                              {{ date('d-m-Y', strtotime($value->admission_date)) }}
                          @endif
                        </td> --}}
                        <td>{{ $value->blood_group }}</td>
                        <td>{{ $value->height }}</td>
                        <td>{{ $value->weight }}</td>
                        <td>{{ ($value->status == 0)? 'Active' :"Inactive" }}</td>
                        <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/student/edit/'. $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ url('admin/student/delete/'. $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                       </tr>
                   @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
