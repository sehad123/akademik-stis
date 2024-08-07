@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Mahasiswa (Total: {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{ url('admin/student/add') }}" class="btn btn-primary">
              <i class="fas fa-plus"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    @include('_message')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
            
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>Nama</label>
                      <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder=" Nama">
                    </div>
                    <div class="form-group col-md-2">
                      <label>NIM</label>
                      <input type="text" class="form-control" value="{{ Request::get('admission_number') }}" name="admission_number" placeholder="NIM">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Kelas</label>
                      <input type="text" class="form-control" value="{{ Request::get('class') }}" name="class" placeholder="Kelas">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Semester</label>
                      <input type="text" class="form-control" value="{{ Request::get('semester') }}" name="semester" placeholder="Kelas">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Jenis Kelamin</label>
                      <select name="gender" class="form-control">
                        <option value="">Select</option>
                        <option {{ (Request::get('gender') =='Laki-Laki')?'selected':'' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ (Request::get('gender') =='Perempuan')?'selected':'' }} value="Perempuan">Perempuan</option>
                        <option {{ (Request::get('gender') =='Other')?'selected':'' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Asal</label>
                      <input type="text" class="form-control" value="{{ Request::get('caste') }}" name="caste" placeholder=" Asal provinsi">
                    </div>
                    <div class="form-group col-md-2">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/student/list') }}" class="btn btn-success mt-4">Clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Profile</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Asal</th>
                        <th>Tanggal Lahir</th>
                        <th>Nomor Hp</th>
                        {{-- <th>Status</th> --}}
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $nomer = 1; @endphp
                      @foreach ($getRecord as $value)
                      <tr>
                        <td>{{ $nomer++ }}</td>
                        <td>
                          @if (!empty($value->getProfile()))
                          <img src="{{ $value->getProfile() }}" class="img-thumbnail" style="width: 50px; height: 50px; border-radius: 50px;" alt="">
                          @endif
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->admission_number }}</td>
                        <td>{{ $value->semester_name }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->caste }}</td>
                        <td>
                          @if(!empty($value->date_of_birth))
                          {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @endif
                        </td>
                        <td>{{ $value->mobile_number }}</td>
                        {{-- <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td> --}}
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/student/edit/'. $value->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ url('admin/student/delete/'. $value->id) }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </a>
                          <a href="{{ url('chat?receiver_id=' . base64_encode($value->id)) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-comments"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="pagination justify-content-end p-2">
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
