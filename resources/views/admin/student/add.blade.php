@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new Student </h1>
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
                      <label >First Name <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('name') }}" name="name" required placeholder="Enter first name">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Last Name<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('last_name') }}" name="last_name" required placeholder="Enter last name">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Addmision Number<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('admission_number') }}" name="admission_number" required placeholder="Enter admission number">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Roll Number<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('roll_number') }}" name="roll_number" required placeholder="Enter role number">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Class<span style="color:red;">*</span></label>
                      <select name="class_id" required class="form-control" id="">
                        <option value="">Select Class</option>
                        @foreach ($getClass as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label >gender<span style="color:red;">*</span></label>
                      <select name="gender" required class="form-control" id="">
                        <option value="">Select Gender</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Tanggal Lahir<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="Enter Tanggal Lahir">
                    </div>

                    <div class="form-group col-md-6">
                      <label >Caste<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('caste') }}" name="caste" required placeholder="Enter caste">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Agama<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('religion') }}" name="religion" required placeholder="Enter Agama">
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Hp<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('mobile_number') }}" name="mobile_number" required placeholder="Enter Mobile Number">
                    </div>

                    <div class="form-group col-md-6">
                      <label >Admission Date<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('admission_date') }}" name="admission_date" required placeholder="Enter addmision_date">
                    </div>

                    <div class="form-group col-md-6">
                      <label >Profile picture<span style="color:red;">*</span></label>
                      <input type="file" class="form-control" name="profile_pic" >
                    </div>
                    <div class="form-group col-md-6">
                      <label >Golongan Darah<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('blood_group') }}" name="blood_group" required placeholder="Enter golongan dara">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Tinggi Badan (cm)<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('height') }}" name="height" required placeholder="Enter Tinggi badan">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Berat Badan (kg)<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('weigth') }}" name="weigth" required placeholder="Enter Berat Badan">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Status<span style="color:red;">*</span></label>
                      <select name="status" required class="form-control" id="">
                        <option value="">Select Status</option>
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                      </select>
                    </div>
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
