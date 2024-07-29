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
          @include('_message')
           
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-group">
                        @if (!empty($getIzin->getDocument()))
                        Bukti :  <a href="{{ $getIzin->getDocument() }}" download="" class="btn btn-warning">Download</a>
                        @endif
                    </div>
                  <div class="form-group">
                    <label >alasan<span style="color: red;">*</span></label>
                      {!! $getIzin->alasan !!}
                  </div>
                  <div class="form-group">
                    <label >Status</label>
                    <input type="text" value="{{  old('status',$getIzin->status)  }}" class="form-control" name="status" required placeholder="Enter name">
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