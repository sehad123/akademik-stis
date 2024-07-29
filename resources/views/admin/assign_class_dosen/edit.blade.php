@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Dosen Matkul  </h1>
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
                      @foreach ($getSubject as $matkul)
                      <option {{ ($getRecord->matkul_id == $matkul->id)? 'selected':'' }}  value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Class Name</label>
                    <select name="class_id" class="form-control" id="">
                      <option value="">Select Class</option>
                      @foreach ($getClass as $class)
                      <option {{ ($getRecord->class_id == $class->id)? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Dosen Name</label>
                      @foreach ($getDosen as $dosen)
                      @php
                          $checked = "";
                      @endphp
                      @foreach ($getAssignDosenID as $dosenAssign)
                          @if ($dosenAssign->dosen_id == $dosen->id)
                          @php
                          $checked = "checked";
                      @endphp
                          @endif
                      @endforeach
                      <div>
                        <label style="font-weight: normal">
                          <input {{ in_array($dosen->id, $getAssignDosenID->pluck('dosen_id')->toArray()) ? 'checked' : '' }} type="checkbox" value="{{ $dosen->id }}" name="dosen_id[]">{{ $dosen->name }}
                        </label>
                      </div>
                      
                        @endforeach
                  </div>
                  <div class="form-group">
                    <label >Status</label>
                    <select name="status" class="form-control" id="">
                      <option value="0"{{ ($getRecord->status ==0) ? 'selected' :'' }}>Active </option>
                      <option value="1"{{ ($getRecord->status ==1) ? 'selected' :'' }}>Inactive </option>
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
