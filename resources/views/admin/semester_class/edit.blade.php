@extends('layouts.app')

<style>
  .checkbox-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 2fr));
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
            <h1>Edit Data</h1>
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
              <!-- form start -->
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                      <label>Pilih Semester</label>
                      <select name="semester_id" class="form-control" required>
                        <option value="">Pilih Semester</option>
                        @foreach ($getSemester as $semester)
                        <option value="{{ $semester->id }}" {{ ($getRecord->semester_id == $semester->id)? 'selected' :'' }}>
                          {{ $semester->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Kelas</label>
                    <div class="checkbox-grid">
                      @foreach ($getClass as $class)
                      @php
                          $checked = "";
                      @endphp
                      @foreach ($getAssignSubjectID as $subjectAssign)
                          @if ($subjectAssign->class_id == $class->id)
                          @php
                          $checked = "checked";
                      @endphp
                          @endif
                      @endforeach
                      <label class="checkbox-item">
                        <input {{ $checked }} type="checkbox" value="{{ $class->id }}" name="class_id[]">{{ $class->name }}
                      </label>
                      @endforeach
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option value="0"{{ ($getRecord->status == 0) ? 'selected' :'' }}>Active</option>
                      <option value="1"{{ ($getRecord->status == 1) ? 'selected' :'' }}>Inactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
