@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Orang Tua </h1>
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
                      <input type="text" class="form-control" required value="{{ old('name') }}" name="name" required placeholder="Nama">
                      <div style="color:red;">
                        {{ $errors->first('name') }}
                    
                    </div>
                    </div>
                  
                    <div class="form-group col-md-6">
                      <label >Jenis Kelamin<span style="color:red;">*</span></label>
                      <select name="gender" required class="form-control" id="">
                        <option value="">Select </option>
                        <option {{ (old('gender') =='Laki-Laki')?'selected':'' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ (old('gender') =='Perempuan')?'selected':'' }} value="Perempuan">Perempuan</option>
                        <option {{ (old('gender') =='Other')?'selected':'' }}  value="Other">Other</option>
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('gender') }}
                    
                    </div>
                    </div>
                   
                    <div class="form-group col-md-6">
                      <label >Alamat<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('address') }}" name="address" required placeholder=" Alamat">
                      <div style="color:red;">
                        {{ $errors->first('address') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Pekerjaan<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('occupation') }}" name="occupation" required placeholder=" Pekerjaan">
                      <div style="color:red;">
                          {{ $errors->first('occupation') }}
                      </div>
                  </div>
                  
                  <div class="form-group col-md-6">
                      <label>No Hp<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Nomor HP">
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
                   
                  </div>
<hr>
                  <div class="form-group">
                    <label >Email<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder=" Email">
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
