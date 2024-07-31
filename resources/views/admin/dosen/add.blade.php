@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Dosen </h1>
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
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label >Nama <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('name') }}" name="name" required placeholder="Nama ">
                      <div style="color:red;">
                        {{ $errors->first('name') }}
                    
                    </div>
                    </div>
                    {{-- <div class="form-group col-md-6">
                      <label >Last Name<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('last_name') }}" name="last_name" required placeholder=" last name">
                      <div style="color:red;">
                        {{ $errors->first('last_name') }}
                    
                    </div>
                    </div> --}}
                  
                    <div class="form-group col-md-6">
                      <label >Jenis Kelamin<span style="color:red;">*</span></label>
                      <select name="gender" required class="form-control" id="">
                        <option value="">Select</option>
                        <option {{ (old('gender') =='Laki-Laki')?'selected':'' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ (old('gender') =='Perempuan')?'selected':'' }} value="Perempuan">Perempuan</option>
                        <option {{ (old('gender') =='Other')?'selected':'' }}  value="Other">Other</option>
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('gender') }}
                    
                    </div>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label >Tanggal Lahir<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder=" Tanggal Lahir">
                      <div style="color:red;">
                        {{ $errors->first('date_of_birth') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Tanggal Gabung<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('admission_date') }}" name="admission_date" required placeholder=" Tanggal Lahir">
                      <div style="color:red;">
                        {{ $errors->first('admission_date') }}
                    
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Mata Kuliah<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('material_status') }}" name="material_status" required placeholder=" Material Status">
                      <div style="color:red;">
                        {{ $errors->first('material_status') }}
                    
                    </div>
                    </div>

                   
                    <div class="form-group col-md-6">
                      <label>No Hp<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('mobile_number') }}" name="mobile_number" required placeholder=" Nomor HP">
                      <div style="color:red;">
                        {{ $errors->first('mobile_number') }}
                    
                    </div>
                    </div>

                    

                    <div class="form-group col-md-6">
                      <label >Profile picture<span style="color:red;">*</span></label>
                      <input type="file" class="form-control mb-3" name="profile_pic" >
                      <div style="color:red;">
                        {{ $errors->first('profile_pic') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Alamat Saat ini<span style="color:red;">*</span></label>
                      <textarea name="address" class="form-control" >{{ old('address') }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('address') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Asal Domisili<span style="color:red;">*</span></label>
                      <textarea name="permanent_address" class="form-control" >{{ old('permanent_address') }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('permanent_address') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >qualification<span style="color:red;">*</span></label>
                      <textarea name="qualification" class="form-control" >{{ old('qualification') }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('qualification') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Pengalaman Kerja<span style="color:red;">*</span></label>
                      <textarea name="work_experience" class="form-control" >{{ old('work_experience') }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('work_experience') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Catatan<span style="color:red;">*</span></label>
                      <textarea name="note" class="form-control" >{{ old('note') }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('note') }}
                    </div>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label >Status<span style="color:red;">*</span></label>
                      <select name="status" required class="form-control" id="">
                        <option value="">Select Status</option>
                        <option value="0" {{ (old('status') ==0)?'selected':'' }}>Active</option>
                        <option value="1" {{ (old('status') ==1)?'selected':'' }}>Inactive</option>
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('status') }}
                    
                    </div>
                    </div>
                  </div>
<hr>
                  <div class="form-group">
                    <label >Email<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder=" email">
                    <div style="color:red;">
                        {{ $errors->first('email') }}
                    
                    </div>
                  </div>
                  <div class="form-group">
                    <label >Password<span style="color:red;">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          
          </div>
          <!--/.col (left) -->
          <!-- right column -->
      
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
