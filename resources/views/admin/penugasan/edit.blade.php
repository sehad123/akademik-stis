@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Tugas </h1>
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
                    <label >Class <span style="color: red;">*</span></label>
                    <select name="class_id" id="getClass" required class="form-control">
                      <option value="">Select Class</option>
                      @foreach ($getClass as $class)
                          <option {{ ($getRecord->class_id == $class->id)? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label >Matkul<span style="color: red;">*</span></label>
                    <select name="matkul_id" id="getMatkul" required class="form-control">
                      <option value="">Select Matkul</option>
                      @foreach ($getMatkul as $matkul)
                      <option {{ ($getRecord->matkul_id ==$matkul->id)? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                  @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label >Tanggal <span style="color: red;">*</span></label>
                    <input type="date" class="form-control" value="{{ old('tanggal',$getRecord->tanggal) }}" name="tanggal" required placeholder="Enter Tanggal">
                  </div>
                  <div class="form-group">
                    <label >Deadline<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" value="{{ old('deadline',$getRecord->deadline) }}" name="deadline" required placeholder="Enter deadline">
                  </div>
                  <div class="form-group">
                    <label >Document<span style="color: red;">*</span></label>
                    <input type="file" class="form-control" value="{{ old('document',$getRecord->tanggal) }}" name="document" required placeholder="Enter document">
                  </div>
                  <div class="form-group">
                    <label >Deskripsi<span style="color: red;">*</span></label>
                    <textarea name="description" id="compose-textarea" class="form-control " style="height: 300px;"> {{ $getRecord->description }}</textarea>
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
<!-- Add these lines for Summernote -->
<link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#compose-textarea',
        plugins: 'autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });

    $('#getClass').change(function(){
      var class_id = $(this).val();
      $.ajax({
        type: "POST",
        url: "{{ url('admin/ajax_get_matkul') }}",
        data: {
            '_token': "{{ csrf_token() }}",
            class_id : class_id,
        },
        dataType: "json",
        success: function(data) {
          $('#getMatkul').html(data.success);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    });
</script>
@endsection