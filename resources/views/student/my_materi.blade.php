@extends('layouts.app')

@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Materi</h1>
          </div>
        
          <div class="col-md-12">
            
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Search Materi </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                  <div class="form-group col-md-3">
                    <label >Matkul</label>
                    <input type="text" class="form-control"  value="{{ Request::get('matkul_name') }}" name="matkul_name" placeholder="Enter matkul_name">
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary mt-4" type="submit">Search</button>
                    <a href="{{ url('student/my_materi') }}" class="btn btn-success mt-4" type="submit">clear</a>
                  </div>
                </div>

                </div>
              </form>
            </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('_message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Daftar Materi Anda </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Matkul</th>
                      <th>Tanggal </th>
                      <th>Deskripsi</th>
                      <th>Document </th>
                    </tr>
                  </thead>
             <tbody>
              @php
                  $i= 1;
              @endphp
              @foreach ($getRecord as $item)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->matkul_name }}</td>
                <td>{{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                <td>{!! $item->description !!}</td>
                <td>
                  @if (!empty($item->getDocument()))
                      <a href="{{ $item->getDocument() }}" download="" class="btn btn-warning">Download</a>
                  @endif
                </td>
              </tr>
              @endforeach
             </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
