@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Presensi Mahasiswa ({{ $getRecord->total() }})</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Search Presensi </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-3">
                      <label >Class </label>
                      <select name="class_id"  id="getClass" class="form-control">
                          <option value="">Select Class</option>
                          @foreach ($getClass as $class)
                          <option {{ (Request::get('class_id') == $class->id)?'selected':''  }} value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Matkul </label>
                      <select id="getMatkul" name="matkul_id" class="form-control getSubject" >
                          <option value="">Select</option>
                          @if (!empty($getSubject))
                              @foreach ($getSubject as $matkul)
                                  <option {{ (Request::get('matkul_id') == $matkul->id) ? 'selected':'' }}  value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                              @endforeach
                          @endif
                      </select>
                  </div>

                    <div class="form-group col-md-3">
                      <label >Tanggal Presensi </label>
                      <input type="date" id="getPresensiDate" value="{{ Request::get('tgl_presensi') }}" name="tgl_presensi" class="form-control" >
                    </div>
                    <div class="form-group col-md-3">
                      <label > Presensi Type </label>
                      <select name="presensi_type"  id="getClass" class="form-control">
                        <option value="">Select</option>
                        <option value="1" {{ (Request::get('tgl_presensi') == 1)?'selected':''  }}>Hadir</option>
                        <option value="2" {{ (Request::get('tgl_presensi') == 2)?'selected':''  }}>Terlambat</option>
                        <option value="3" {{ (Request::get('tgl_presensi') == 3)?'selected':''  }}>Sakit</option>
                        <option value="4" {{ (Request::get('tgl_presensi') == 4)?'selected':''  }}>Izin</option>
                        <option value="5" {{ (Request::get('tgl_presensi') == 5)?'selected':''  }}>Terlambat</option>
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/presensi/report') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Presensi Mahasiswa List</h3>
                </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mahasiswa Name</th>
                            <th>Class</th>
                            <th>Matkul</th>
                            <th>Presensi</th>
                            <th>Tgl Presensi</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i  = 1;
                        @endphp
                        @forelse($getRecord as $value)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                            <td>{{ $value->class_name }} </td>
                            <td>{{ $value->matkul_name }} </td>
                            <td>
                                @if ($value->presensi_type == 1)
                                Hadir
                                @elseif ($value->presensi_type == 2)
                                Terlambat
                                @elseif ($value->presensi_type == 3)
                                Sakit
                                @elseif ($value->presensi_type == 4)
                                Izin
                                @elseif ($value->presensi_type == 5)
                                Tidak Hadir
                                @endif
                            </td>
                            <td>{{ $value->tgl_presensi }}</td>
                            <td>{{ date('d-m-Y H:i:A',strtotime($value->created_at)) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%">Record not Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
                  <div style="padding: 10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
          </div>
            </div>
        </div>
    </div>

    </section>
  </div>

@endsection