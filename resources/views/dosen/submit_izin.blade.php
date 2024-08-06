@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Formulir Perizinan Dosen</h1>
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
                                    <label>Document<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" value="{{ old('bukti') }}" name="bukti" required placeholder="Enter bukti">
                                </div>
                                <div class="form-group">
                                    <label>Alasan<span style="color: red;">*</span></label>
                                    <textarea name="alasan" id="compose-textarea" class="form-control" style="height: 300px;"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Keterangan</label>
                                    <select class="form-control" name="keterangan" required>
                                      <option value="rawat inap">Rawat Inap</option>
                                      <option value="rawat jalan">Rawat Jalan</option>
                                      <option value="acara keluarga">Acara Keluarga</option>
                                      <option value="kematian">Kematian</option>
                                      <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                    </select>
                                  </div>
                                </div> --}}
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

<script>
    $(document).ready(function() {
        $('#compose-textarea').summernote({
            height: 300,   // Set editor height
            minHeight: null, // Set minimum height of editor
            maxHeight: null, // Set maximum height of editor
            focus: true    // Set focus to editable area after initializing summernote
        });
    });
</script>
@endsection
