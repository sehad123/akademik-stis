@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambahkan Materi</h1>
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
              <form method="post" action="" enctype="multipart/form-data">
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
                    <label>Kelas <span style="color: red;">*</span></label>
                    <select name="class_id"  required class="form-control getClass">
                      <option value="">Select</option>
                      @foreach ($getClass as $class)
                          <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Mata Kuliah<span style="color: red;">*</span></label>
                    <select name="matkul_id" class="form-control getSubject" required>
                      @if (!empty($getSubject))
                          @foreach ($getSubject as $matkul)
                              <option {{ (Request::get('matkul_id') == $matkul->matkul_id) ? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                          @endforeach
                      @endif
                  </select>
                  </div>
                  <div class="form-group">
                    <label>Tanggal <span style="color: red;">*</span></label>
                    <input type="date" class="form-control" value="{{ old('tanggal') }}" name="tanggal" required placeholder="Enter Tanggal">
                  </div>
                 
                  <div class="form-group">
                    <label>Document<span style="color: red;">*</span></label>
                    <input type="file" class="form-control" value="{{ old('document') }}" name="document" required placeholder="Enter document">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi<span style="color: red;">*</span></label>
                    <textarea name="description" class="form-control" style="height: 300px;">{{ old('description') }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('script')
<script>
 $('.getSemester').change(function()
{
    var semester_id = $(this).val();
    $.ajax({
      url: "{{ url('dosen/semester_class/get_semester') }}",
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

    // $('#getClass').change(function(){
    //     var class_id = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "{{ url('dosen/ajax_get_matkul') }}",
    //         data: {
    //             '_token': "{{ csrf_token() }}",
    //             class_id: class_id,
    //         },
    //         dataType: "json",
    //         success: function(data) {
    //             $('#getMatkul').html(data.success);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // });

    $('.getClass').change(function()
{
    var semester_id = $('.getSemester').val();
    var class_id = $('.getClass').val();
     // Log semester_id and class_id
     console.log("Semester ID:", semester_id);
            console.log("Class ID:", class_id);
    $.ajax({
        url:"{{ url('dosen/semester_class/get_semester_subject') }}",
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
