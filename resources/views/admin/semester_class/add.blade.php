@extends('layouts.app')
<style>
  .checkbox-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(100px, 2fr));
      gap: 5px;
  }
  
  .checkbox-item {
      display: flex;
      align-items: center;
  }
  </style>
  
@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Kelas & Semester </h1>
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
                    <label>Semester</label>
                    <select name="semester_id" class="form-control">
                      <option value="">Pilih Semester</option>
                      @foreach ($getSemester as $semester)
                      <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <label>Kelas</label>
                    <div class="checkbox-grid">
                      @foreach ($getClass as $class)
                      <label class="checkbox-item">
                          <input type="checkbox" value="{{ $class->id }}" name="class_id[]">{{ $class->name }}
                      </label>
                      @endforeach
                    </div>
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
