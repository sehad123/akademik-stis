@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Matkul Dosen </h1>
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
                    <label >Nama Matkul</label>
                      <select name="matkul_id" class="form-control" required>
                        <option value="">Select Matkul</option>
                        @foreach ($getSubject as $subject)
                        <option value="{{ $subject->id }}" {{ ($getRecord->matkul_id == $subject->id)? 'selected' :'' }}>
                          {{ $subject->name }}</option>
                          
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label >Class Name</label>
                        <select name="class_id" class="form-control" required>
                          <option value="">Select Class</option>
                          @foreach ($getClass as $class)
                          <option value="{{ $class->id }}" {{ ($getRecord->class_id == $class->id)? 'selected' :'' }}>
                            {{ $class->name }}</option>
                            @endforeach
                          </select>
                        </div>


                      <div class="form-group">
                          <label >Nama Dosen </label>
                          <select name="dosen_id" class="form-control" required>
                            <option value="">Select Dosen</option>
                            @foreach ($getDosen as $dosen)
                            <option value="{{ $dosen->id }}" {{ ($getRecord->dosen_id == $dosen->id)? 'selected' :'' }}>
                              {{ $dosen->name }} {{ $dosen->last_name }}</option>
                              
                              @endforeach
                            </select>
                          </div>

                      

                        <div class="form-group">
                          <label >Status</label>
                          <select name="status" class="form-control" id="">
                            <option value="0"{{ ($getRecord->status ==0) ? 'selected' :'' }}>Active </option>
                            <option value="1"{{ ($getRecord->status ==1) ? 'selected' :'' }}>Inactive </option>
                          </select>
                        </div>
                    
                     </div>
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
