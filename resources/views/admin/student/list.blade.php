@extends('layouts.app')

@section('content')
    


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Mahasiswa ( Total : {{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Tambah Mahasiswa</a>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <!-- Main content -->
    <section class="content">
      
      <div class="container-fluid">
        <div class="row">
      
          <!-- /.col -->
            
               
              
             
            
            <div class="col-md-12">

              <div class="card ">
                <div class="card-header">
                  <h3 class="card-title">Search Student </h3>
                </div>
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">

                    <div class="form-group col-md-2">
                      <label >Nama</label>
                      <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Enter name">
                    </div>
                    {{-- <div class="form-group col-md-2">
                      <label >Last Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Enter Last name">
                    </div> --}}
                    <div class="form-group col-md-2">
                      <label >NIM</label>
                      <input type="text" class="form-control"  value="{{ Request::get('admission_number') }}" name="admission_number" placeholder="NIM">
                    </div>
                    <div class="form-group col-md-2">
                      <label >Kelas</label>
                      <input type="text" class="form-control"  value="{{ Request::get('class') }}" name="class" placeholder="Class">
                    </div>
                    <div class="form-group col-md-2">
                      <label >Gender</label>
                      <select name="gender" class="form-control" id="">
                      <option value="">Select Gender</option>
                      <option {{ (Request::get('gender') =='Laki-Laki')?'selected':'' }} value="Laki-Laki">Laki-Laki</option>
                      <option {{ (Request::get('gender') =='Perempuan')?'selected':'' }} value="Perempuan">Perempuan</option>
                      <option {{ (Request::get('gender') =='Other')?'selected':'' }}  value="Other">Other</option>
                    </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label >Email</label>
                      <input type="text" class="form-control"  value="{{ Request::get('email') }}" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-2">
                      <label >Asal</label>
                      <input type="text" class="form-control"  value="{{ Request::get('caste') }}" name="caste" placeholder="Enter asal provinsi">
                    </div>
                    {{-- <div class="form-group col-md-2">
                      <label >Agama</label>
                      <input type="text" class="form-control"  value="{{ Request::get('religion') }}" name="religion" placeholder="Enter Agama">
                    </div> --}}
                    {{-- <div class="form-group col-md-2">
                      <label >Status</label>
                      <select name="gender" class="form-control" id="">
                      <option value="">Select Status</option>
                      <option {{ (Request::get('status') ==100)?'selected':'' }} value="100">Active</option>
                      <option {{ (Request::get('status') ==1)?'selected':'' }} value="1">Inactive</option>
                    </select>
                    </div> --}}

                    {{-- <div class="form-group col-md-2">
                      <label >Date</label>
                      <input type="date" class="form-control"  value="{{ Request::get('date') }}" name="date" placeholder="Enter date">
                    </div> --}}
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/student/list') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>

                  </div>
                </form>
              </div>
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Student List </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>profile_pic</th>
                      <th>Nama</th>
                      {{-- <th>Parent Name</th> --}}
                      <th>Email</th>
                      <th>NIM</th>
                      {{-- <th>Roll Number</th> --}}
                      <th>Kelas</th>
                      <th>Gender</th>
                      <th>Asal</th>
                      <th>Tanggal Lahir</th>
                      {{-- <th>Agama</th> --}}
                      <th>Nomer Hp</th>
                      {{-- <th>Admission Date</th> --}}
                      {{-- <th>Golongan Darah</th> --}}
                      {{-- <th>Tinggi Badan</th> --}}
                      {{-- <th>Berat Badan</th> --}}
                      <th>Status</th>
                      {{-- <th>Created Date</th> --}}
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $nomer = 1;
                @endphp
               @foreach ($getRecord as $value)
                   <tr>
                    <td>{{ $nomer++ }}</td>
                        <td>
                          @if (!empty($value->getProfile()))
                          <img src="{{  $value->getProfile()}}" style="width: 50px; height:50px; border-radius:50px;" alt="">
                          @endif
                        </td>
                        <td>{{ $value->name }}</td>
                        {{-- <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td> --}}
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->admission_number }}</td>
                        {{-- <td>{{ $value->roll_number }}</td> --}}
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->caste }}</td>
                        <td>
                           
                          @if(!empty($value->date_of_birth ))
                              {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @endif
                        </td>
                        {{-- <td>{{ $value->religion }}</td> --}}
                        <td>{{ $value->mobile_number }}</td>
                        {{-- <td>{{ $value->admission_date }}</td> --}}
                        {{-- <td>
                           
                          @if(!empty($value->admission_date ))
                              {{ date('d-m-Y', strtotime($value->admission_date)) }}
                          @endif
                        </td> --}}
                        {{-- <td>{{ $value->blood_group }}</td> --}}
                        {{-- <td>{{ $value->height }}</td> --}}
                        {{-- <td>{{ $value->weight }}</td> --}}
                        <td>{{ ($value->status == 0)? 'Active' :"Inactive" }}</td>
                        {{-- <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td> --}}
                        <td style="min-width: 150px;">
                          <a href="{{ url('admin/student/edit/'. $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ url('admin/student/delete/'. $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                          <a href="{{ url('chat?receiver_id=' .base64_encode($value->id)) }}" class="btn btn-success btn-sm">Chat</a>
                        </td>
                       </tr>
                   @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float:right;"></div>
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                {{-- {!! $getRecord->append() !!} --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
     
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
