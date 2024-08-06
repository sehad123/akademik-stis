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
                    <label>Kelas</label>
                    <select name="class_id" id="getClass" class="form-control">
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
                      <option value="{{ $dosen->id }}">{{ $dosen->name }} {{ $dosen->last_name }}</option>
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
    $('#getClass').change(function() {
    var class_id = $(this).val();
    $.ajax({
        url: "{{ url('admin/presensi/get_subjects') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            class_id: class_id,
        },
        dataType: "json",
        success: function(response) {
            $('#getMatkul').html(response.subject_html);
        },
    });
});
</script>
@endsection
