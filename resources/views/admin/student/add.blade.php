@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Mahasiswa Baru </h1>
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
                      <input type="text" class="form-control" required value="{{ old('name') }}" name="name" required placeholder="Enter first name">
                      <div style="color:red;">
                        {{ $errors->first('name') }}
                    
                    </div>
                    </div>
                    {{-- <div class="form-group col-md-6">
                      <label >Last Name<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('last_name') }}" name="last_name" required placeholder="Enter last name">
                      <div style="color:red;">
                        {{ $errors->first('last_name') }}
                    
                    </div>
                    </div> --}}
                    <div class="form-group col-md-6">
                      <label >NIM<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('admission_number') }}" name="admission_number" required placeholder="Enter NIM">
                      <div style="color:red;">
                        {{ $errors->first('admission_number') }}
                    
                    </div>
                    </div>
                    {{-- <div class="form-group col-md-6">
                      <label >Roll Number<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('roll_number') }}" name="roll_number" required placeholder="Enter role number">
                      <div style="color:red;">
                        {{ $errors->first('roll_number') }}
                    
                    </div>
                    </div> --}}
                    <div class="form-group col-md-6">
                      <label >Kelas<span style="color:red;">*</span></label>
                      <select name="class_id" required class="form-control" id="">
                        <option value="">Pilih Kelas</option>
                        @foreach ($getClass as $item)
                            <option {{ (old('class_id') ==$item->id)?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('class_id') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >gender<span style="color:red;">*</span></label>
                      <select name="gender" required class="form-control" id="">
                        <option value="">Select Gender</option>
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
                      <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="Enter Tanggal Lahir">
                      <div style="color:red;">
                        {{ $errors->first('date_of_birth') }}
                    
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label >Asal<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('caste') }}" name="caste" required placeholder="Enter Asal">
                      <div style="color:red;">
                        {{ $errors->first('caste') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Agama<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('religion') }}" name="religion" required placeholder="Enter Agama">
                      <div style="color:red;">
                        {{ $errors->first('religion') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Hp<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Enter Mobile Number">
                      <div style="color:red;">
                        {{ $errors->first('mobile_number') }}
                    
                    </div>
                    </div>

                    {{-- <div class="form-group col-md-6">
                      <label >Admission Date<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('admission_date') }}" name="admission_date" required placeholder="Enter addmision_date">
                      <div style="color:red;">
                        {{ $errors->first('admission_date') }}
                    </div>
                    </div> --}}

                    <div class="form-group col-md-6">
                      <label >Profile picture<span style="color:red;">*</span></label>
                      <input type="file" class="form-control" name="profile_pic" >
                      <div style="color:red;">
                        {{ $errors->first('profile_pic') }}
                    
                    </div>
                    </div>
                    {{-- <div class="form-group col-md-6">
                      <label >Golongan Darah<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('blood_group') }}" name="blood_group" required placeholder="Enter golongan dara">
                      <div style="color:red;">
                        {{ $errors->first('blood_group') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Tinggi Badan (cm)<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('height') }}" name="height" required placeholder="Enter Tinggi badan">
                      <div style="color:red;">
                        {{ $errors->first('height') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Berat Badan (kg)<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('weigth') }}" name="weigth" required placeholder="Enter Berat Badan">
                      <div style="color:red;">
                        {{ $errors->first('weight') }}
                    
                    </div>
                    </div> --}}
                    {{-- <div class="form-group col-md-6">
                      <label >Status<span style="color:red;">*</span></label>
                      <select name="status" required class="form-control" id="">
                        <option value="">Select Status</option>
                        <option value="0" {{ (old('status') ==0)?'selected':'' }}>Active</option>
                        <option value="1" {{ (old('status') ==1)?'selected':'' }}>Inactive</option>
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('status') }}
                    
                    </div>
                    </div> --}}
                  </div>

                
<hr>
                  <div class="form-group">
                    <label >Email<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Enter email">
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
