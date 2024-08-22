@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulir Perizinan</h1>
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
                        @include('_message')

                        @if (is_null($getIzin) || (empty($getIzin->bukti) && empty($getIzin->alasan)  && empty($getIzin->status)))
                        <div class="card-body text-center">
                            <p>Belum ada bukti terupload</p>
                        </div>
                        @else
                        <!-- form start -->
                        <form method="post" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        @if (!empty($getIzin->getDocument()))
                                        Bukti: <a href="{{ $getIzin->getDocument() }}" download="" class="btn btn-warning">Download</a>
                                        @else
                                        <p>Tidak mengirimkan bukti</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alasan: <span style="color: red;">*</span></label>
                                    {!! $getIzin->alasan !!}
                                </div>
                               
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="belum diterima" {{ old('status', $getIzin->status) == 'belum diterima' ? 'selected' : '' }}>Belum Diterima</option>
                                        <option value="ditolak" {{ old('status', $getIzin->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        <option value="diterima" {{ old('status', $getIzin->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    </select>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary SavePresensi">Submit</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<!-- Add these lines for Summernote -->
<link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.min.css')}}">
<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="https://cdn.tiny.cloud/  /your-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
