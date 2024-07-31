@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Orang Tua (Total: {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">
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
                      <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Jenis Kelamin</label>
                      <select name="gender" class="form-control">
                        <option value="">Select</option>
                        <option {{ (Request::get('gender') =='Laki-Laki') ? 'selected' : '' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ (Request::get('gender') =='Perempuan') ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                        <option {{ (Request::get('gender') =='Other') ? 'selected' : '' }} value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Email</label>
                      <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Alamat</label>
                      <input type="text" class="form-control" value="{{ Request::get('address') }}" name="address" placeholder="Alamat">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Pekerjaan</label>
                      <input type="text" class="form-control" value="{{ Request::get('occupation') }}" name="occupation" placeholder="Pekerjaan">
                    </div>
                    <div class="form-group col-md-2">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/parent/list') }}" class="btn btn-success mt-4">Clear</a>
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
                        <th>#</th>
                        <th>Profile</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>No HP</th>
                        <th>Pekerjaan</th>
                        <th>Alamat</th>
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
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->mobile_number }}</td>
                        <td>{{ $value->occupation }}</td>
                        <td>{{ $value->address }}</td>
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/parent/edit/'. $value->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ url('admin/parent/delete/'. $value->id) }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </a>
                          <a href="{{ url('admin/parent/my-children/'. $value->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-list"></i>
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
