@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Formulir Perizinan </h1>
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
                  <div class="form-group">
                    <label >Document<span style="color: red;">*</span></label>
                    <input type="file" class="form-control" value="{{ old('bukti') }}" name="bukti" required placeholder="Enter bukti">
                  </div>
                  <div class="form-group">
                    <label >alasan<span style="color: red;">*</span></label>
                    <textarea name="alasan" id="compose-textarea" class="form-control " style="height: 300px;"></textarea>
                  </div>
                 
                
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary SavePresensi">Submit</button>
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

</script>
@endsection