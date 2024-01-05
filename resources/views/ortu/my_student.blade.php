@extends('layouts.app')

@section('content')
    


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="card-title"> My children </h1>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> My Children  </h3>
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
                      <th>NIM</th>
                      <th>Class</th>
                      <th>Gender</th>
                      <th>Tanggal Lahir</th>
                      <th>Religion</th>
                      <th>Nomer Hp</th>
                      <th>Tinggi Badan (cm)</th>
                      <th>Berat Badan (kg)</th>
                      <th>Created Date</th>
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
                          @if (!empty($value->getProfile()))
                          <img src="{{  $value->getProfile()}}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                          @endif
                        </td>
                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                        <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->admission_number }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>
                          @if(!empty($value->date_of_birth ))
                              {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @endif
                        </td>
                        <td>{{ $value->religion }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        <td>{{ $value->height }}</td>
                        <td>{{ $value->weight }}</td>
                        <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                        <td>
                          <a href="{{ url('ortu/my_student/subject/'.$value->id) }}" class="btn btn-primary btn-sm">Matkul</a>
                        </td>
                   @endforeach
                      
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
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
