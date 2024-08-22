@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Dosen & Mata Kuliah</h1>
          </div>
        </div>
      </div>
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
                    <select name="class_id" id="getClass" class="form-control getClass">
                      <option value="">Select</option>
                      @foreach ($getClass as $class)
                      <option {{ (Request::get('class_id') == $class->id)?'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <label>Mata Kuliah</label>
                    <select id="getMatkul" name="matkul_id" class="form-control getSubject">
                      <option value="">Select</option>
                      @if (!empty($getSubject))
                      @foreach ($getSubject as $matkul)
                      <option {{ (Request::get('matkul_id') == $matkul->id) ? 'selected':'' }} value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                      @endforeach
                      @endif
                  </select>
                  </div>

                  <div class="form-group">
                    <label>Dosen</label>
                    <select name="dosen_id" class="form-control">
                      <option value="">Pilih Dosen</option>
                      @foreach ($getDosen as $dosen)
                      <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
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

    // $('#getClass').change(function() {
    // var class_id = $(this).val();
    // $.ajax({
    //     url: "{{ url('admin/presensi/get_subjects') }}",
    //     type: "POST",
    //     data: {
    //         "_token": "{{ csrf_token() }}",
    //         class_id: class_id,
    //     },
    //     dataType: "json",
    //     success: function(response) {
    //         $('#getMatkul').html(response.subject_html);
    //     },
    // });

    $('.getClass').change(function()
{
    var semester_id = $('.getSemester').val();
    var class_id = $('.getClass').val();
     // Log semester_id and class_id
     console.log("Semester ID:", semester_id);
            console.log("Class ID:", class_id);
    $.ajax({
        url:"{{ url('admin/semester_class/get_semester_subject') }}",
        type: "POST",
        data:{
            "_token":"{{ csrf_token() }}",
            semester_id:semester_id,
            class_id:class_id,
        },
        dataType:"json",
        success:function(response){
            $('.getSubject').html(response.html);
        },
    });
});
    

</script>
@endsection
