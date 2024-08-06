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
  </style>
  
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Kelas & Mata Kuliah  </h1>
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
                    <label>Nama Kelas</label>
                    <select name="class_id" class="form-control">
                      <option value="">Pilih Kelas</option>
                      @foreach ($getClass as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Nama Mata Kuliah</label>
                    <div class="checkbox-grid">
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
