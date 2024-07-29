@extends('layouts.app')

@section('content')
    


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Grade Nilai </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/penilaian/mark_grade_add') }}" class="btn btn-primary">add new Grade</a>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    

    @include('_message')
    <!-- Main content -->
    <section class="content">
      
      <div class="container-fluid">
        <div class="row">
      
            <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Grade Nilai </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Grade Name</th>
                      <th>Percent From</th>
                      <th>Percent To</th>
                      <th>Percent By</th>
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
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->percent_from }}</td>
                        <td>{{ $value->percent_to }}</td>
                        <td>{{ $value->created_name }}</td>
                        <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                        <td>
                          <a href="{{ url('admin/penilaian/mark_grade/edit/'. $value->id) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ url('admin/penilaian/mark_grade/delete/'. $value->id) }}" class="btn btn-danger">Delete</a>
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
