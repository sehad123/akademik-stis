@extends('layouts.app')

@section('content')
    

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Papan Pengumuman</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/komunikasi/pengumuman/add') }}" class="btn btn-primary">add new Pengumuman</a>
          </div>
        

          <div class="col-md-12">

            <!-- general form elements -->
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Search Class </h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-3">
                                <label>judul</label>
                                <input type="text" class="form-control" value="{{ Request::get('judul') }}"
                                    name="judul" placeholder="Enter judul">
                            </div>
                           
                            <div class="form-group col-md-3">
                                <label> Pengumuman To</label>
                                <input type="date" class="form-control" value="{{ Request::get('pengumuman_to') }}"
                                    name="pengumuman_to" placeholder="Enter Date">
                            </div>
                            <div class="form-group col-md-3">
                                <label> Pengumuman From</label>
                                <input type="date" class="form-control" value="{{ Request::get('pengumuman_from') }}"
                                    name="pengumuman_from" placeholder="Enter Date">
                            </div>
                            <div class="form-group col-md-3">
                                <label> Publish To</label>
                                <input type="date" class="form-control" value="{{ Request::get('publish_to') }}"
                                    name="publish_to" placeholder="Enter Date">
                            </div>
                            <div class="form-group col-md-3">
                                <label> Publish From</label>
                                <input type="date" class="form-control" value="{{ Request::get('publish_from') }}"
                                    name="publish_from" placeholder="Enter Date">
                            </div>
                            {{-- <div class="form-group col-md-2">
                                <label> Untuk</label>
                                <select name="pesan_to" id="" class="form-control">
                                  <option value="">Select</option>
                                  <option {{ (Request::get('pesan_to') == 3)? 'selected':'' }} value="3">Mahasiswa</option>
                                  <option {{ (Request::get('pesan_to') == 4)? 'selected':'' }} value="4">Orang Tua</option>
                                  <option {{ (Request::get('pesan_to') == 2)? 'selected':'' }} value="2">Dosen</option>
                                </select>
                            </div> --}}
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary mt-4" type="submit">Search</button>
                                <a href="{{ url('admin/komunikasi/pengumuman') }}" class="btn btn-success mt-4"
                                    type="submit">clear</a>
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
            @include('_message');
            <!-- /.card -->
            <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Papan Pengumuman </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Judul</th>
                      <th>Tanggal Pengumuman</th>
                      <th>Tanggal Publish</th>
                      <th>Untuk </th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=1;
                    @endphp
                 @forelse ($getRecord as $item)
                     <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $item->judul }}</td>
                      <td>{{ date('d-m-Y',strtotime( $item->tgl_pengumuman)) }}</td>
                      <td>{{ date('d-m-Y',strtotime( $item->tgl_publish)) }}</td>
                      <td>
                        @foreach ($item->getPesan as $pesan)
                             @if ($pesan->pesan_to == 2)
                             <p>Dosen</p>
                             @elseif ($pesan->pesan_to == 3)
                             <p>
                               Mahasiswa
                             </p>
                             @elseif ($pesan->pesan_to == 4)
                             <p>
                               Orang Tua    
                             </p>
                             @endif
                        @endforeach
                      </td>
                      <td>{{ $item->created_name }}</td>
                      <td>{{ date('d-m-Y',strtotime( $item->created_at)) }}</td>
                      <td>
                        <a href="{{ url('admin/komunikasi/pengumuman/edit/'. $item->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('admin/komunikasi/pengumuman/delete/'. $item->id) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                     <td colspan="100%">Pengumuman tidak ditemukan</td>
                    </tr>
                    @endforelse
                  </tbody>
                  <div style="padding: 10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
                </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
