@extends('layouts.app')
<style>
  .checkbox-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 2fr));
      gap: 10px;
  }
  
  .checkbox-item {
      display: flex;
      align-items: center;
  }

  .search-input {
      margin-bottom: 10px;
  }
</style>
  
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Kelas & Mata Kuliah</h1>
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
                    <select name="semester_id"  class="form-control getSemester" required>
                      <option value="">Select</option>
                      @foreach ($getSemester as $semester)
                          <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                      @endforeach
                  </select>
                  
                  </div>

                  <div class="form-group">
                    <label>Kelas</label>
                    <select required name="class_id" class="form-control getClass">
                      <option value="">Select</option>
                      @if (!empty($getClass))
                      @foreach ($getClass as $class)
                      <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Nama Mata Kuliah</label>
                    <input type="text" id="search" class="form-control search-input" placeholder="Cari Mata Kuliah...">
                    <div class="checkbox-grid" id="subjectList">
                      @foreach ($getSubject as $subject)
                      <label class="checkbox-item">
                          <input type="checkbox" value="{{ $subject->id }}" name="matkul_id[]">{{ $subject->name }}
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')
<script>
  // Filter mata kuliah berdasarkan input pencarian
  document.getElementById('search').addEventListener('input', function() {
    var query = this.value.toLowerCase();
    var subjects = document.querySelectorAll('#subjectList .checkbox-item');

    subjects.forEach(function(subject) {
      var subjectName = subject.textContent.toLowerCase();
      if (subjectName.includes(query)) {
        subject.style.display = '';
      } else {
        subject.style.display = 'none';
      }
    });
  });

  $('.getSemester').change(function() {
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
@endsection
