@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new Pengumuman </h1>
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
                    <label >Judul</label>
                    <input type="text" class="form-control" value="{{ old('judul') }}" name="judul" required placeholder="Enter judul">
                  </div>
                 
                  <div class="form-group">
                    <label >Tanggal Pengumuman</label>
                    <input type="date" class="form-control" value="{{ old('tgl_pengumuman') }}" name="tgl_pengumuman" required placeholder="Enter tgl_pengumuman">
                  </div>
                  <div class="form-group">
                    <label >Tanggal Publikasi</label>
                    <input type="date" class="form-control" value="{{ old('tgl_publish') }}" name="tgl_publish" required placeholder="Enter tgl_publish">
                  </div>
                  <div class="form-group">
                    <label style="display: block;">Untuk Siapa</label> <br>
                    <label class="mr-5" ><input value="3" name="pesan_to[]" type="checkbox">Mahasiswa</label>
                    <label class="mr-5" ><input value="4" name="pesan_to[]" type="checkbox">Orang tua</label>
                    <label ><input name="pesan_to[]" value="2" type="checkbox">Dosen</label>
                  </div>
                  <div class="form-group">
                    <label >Pesan</label>
                    <textarea name="pesan" id="compose-textarea" class="form-control " style="height: 300px;"></textarea>
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
    <!-- /.content -->
  </div>
@endsection

@section('script')
<!-- Add these lines for Summernote -->
<link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- Include TinyMCE script -->
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
