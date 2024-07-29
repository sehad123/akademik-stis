@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Dosen Matkul  </h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
           
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Matkul Name</label>
                    <select name="matkul_id" class="form-control" id="">
                      <option value="">Select Matkul</option>
                      @foreach ($getSubject as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Class Name</label>
                    <select name="class_id" class="form-control" id="">
                      <option value="">Select Class</option>
                      @foreach ($getClass as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Dosen Name</label>
                    @foreach ($getDosen as $dosen)
                    <div>
                      <label style="font-weight: normal">
                        <input  type="checkbox" value="{{ $dosen->id }}" name="dosen_id[]">{{ $dosen->name }} {{ $dosen->last_name }}
                      </label>
                    </div>
                      @endforeach
                  </div>
                  <div class="form-group">
                    <label >Status</label>
                    <select name="status" class="form-control" id="">
                      <option value="0">Active</option>
                      <option value="1">Inactive</option>
                    </select>
                  </div>
                  
                 
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          
          </div>
          <!--/.col (left) -->
          <!-- right column -->
      
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
