@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Kehadiran Saya</h1>
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
              {{-- <div class="card-header">
                <h3 class="card-title">Search Presensi </h3>
              </div> --}}
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                    {{-- <div class="form-group col-md-3">
                      <label>Matkul </label>
                      <select id="getMatkul" name="matkul_id" class="form-control getSubject" >
                          <option value="">Select</option>
                          @if (!empty($getSubject))
                              @foreach ($getSubject as $matkul)
                                  <option {{ (Request::get('matkul_id') == $matkul->id) ? 'selected':'' }}  value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                              @endforeach
                          @endif
                      </select>
                  </div> --}}

                    <div class="form-group col-md-3">
                      <label >Tanggal Presensi </label>
                      <input type="date" id="getPresensiDate" value="{{ Request::get('tgl_presensi') }}" name="tgl_presensi" class="form-control" >
                    </div>
                    <div class="form-group col-md-3">
                      <label > Type </label>
                      <select name="presensi_type"  id="getClass" class="form-control">
                        <option value="">Select</option>
                        <option value="1" {{ (Request::get('tgl_presensi') == 1)?'selected':''  }}>Hadir</option>
                        <option value="2" {{ (Request::get('tgl_presensi') == 2)?'selected':''  }}>Terlambat A</option>
                        <option value="3" {{ (Request::get('tgl_presensi') == 3)?'selected':''  }}>Terlambat B</option>
                        <option value="4" {{ (Request::get('tgl_presensi') == 4)?'selected':''  }}>Sakit</option>
                        <option value="5" {{ (Request::get('tgl_presensi') == 5)?'selected':''  }}>Izin</option>
                        <option value="6" {{ (Request::get('tgl_presensi') == 6)?'selected':''  }}>Terlambat</option>
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('student/my_presensi') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
            <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                  <h3 class="card-title text-center">My Presensi </h3>
                </div> --}}
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Status </th>
                            <th>Tgl Presensi</th>
                            <th>Image </th>
                            @if ($getRecord->firstWhere('presensi_type', 4) || $getRecord->firstWhere('presensi_type', 5))
                            <th>Action</th>
                            @endif                        </tr>
                    </thead>
               <tbody>
                @forelse ($getRecord as $value)
                    <tr>
                        {{-- <td>{{ $value->class_name }} </td> --}}
                        <td>{{ $value->matkul_name }} </td>
                            <td>
                              @if ($value->presensi_type == 1)
                              Hadir
                              @elseif ($value->presensi_type == 2)
                              Terlambat A
                              @elseif ($value->presensi_type == 3)
                              Terlambat B
                              @elseif ($value->presensi_type == 4)
                              Sakit
                              @elseif ($value->presensi_type == 5)
                              Izin
                              @elseif ($value->presensi_type == 6)
                              Tidak Hadir
                              @endif
                            </td>
                            <td>{{ date('d-m-Y',strtotime($value->tgl_presensi))  }}</td>
                            <td>
                              @if (!empty($value->getProfilePresensi()))
                              <img src="{{ $value->getProfilePresensi() }}" class="img-thumbnail" style="width: 50px; height: 50px; border-radius: 50px;" alt="">
                              @endif
                            </td>
                            @if ($value->presensi_type == 4 || $value->presensi_type == 5)
                            <td>
                              <a href="{{ url('student/perizinan/'.$value->id.'/'. Auth::user()->id .'/'. $value->class_id.'/'.$value->matkul_id) }}" class="btn btn-warning">Upload bukti sakit / izin</a>
                              <a href="{{ url('student/detail_perizinan/'.$value->id.'/'. Auth::user()->id .'/'. $value->class_id.'/'.$value->matkul_id) }}" class="btn btn-primary">Detail sakit / izin</a>
                            </td>
                            @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%"> Tidak Ditemukan</td>
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