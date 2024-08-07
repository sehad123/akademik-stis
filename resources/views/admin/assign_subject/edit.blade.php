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
                    <label>Semester</label>
                    <select name="semester_id"  class="form-control getSemester">
                      <option value="">Select</option>
                      @foreach ($getSemester as $semester)
                      <option value="{{ $semester->id }}" {{ ($getRecord->semester_id == $semester->id)? 'selected' :'' }}>
                        {{ $semester->name }}</option>                      @endforeach
                  </select>
                  
                  </div>

                  <div class="form-group">
                      <label>Pilih Kelas</label>
                      <select name="class_id" class="form-control getClass" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($getClass as $class)
                        <option value="{{ $class->id }}" {{ ($getRecord->class_id == $class->id)? 'selected' :'' }}>
                          {{ $class->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Mata Kuliah</label>
                    <div class="checkbox-grid">
                      @foreach ($getSubject as $subject)
                      @php
                          $checked = "";
                      @endphp
                      @foreach ($getAssignSubjectID as $subjectAssign)
                          @if ($subjectAssign->matkul_id == $subject->id)
                          @php
                          $checked = "checked";
                      @endphp
                          @endif
                      @endforeach
                      <label class="checkbox-item">
                        <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="matkul_id[]">{{ $subject->name }}
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
@section('script')
<script>
  $('.getSemester').change(function()
{
    var semester_id = $(this).val();
    $.ajax({
      url: "{{ url('admin/semester_class/get_semester') }}",
      type: "POST",
        data:{
            "_token":"{{ csrf_token() }}",
            semester_id:semester_id,
        },
        dataType:"json",
        success:function(response){
            $('.getClass').html(response.html);
        },
    });
});

</script>
