@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account </h1>
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
            @include('_message')
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
                      <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" required placeholder="Enter first name">
                      <div style="color:red;">
                        {{ $errors->first('name') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Last Name<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('last_name',$getRecord->last_name) }}" name="last_name" required placeholder="Enter last name">
                      <div style="color:red;">
                        {{ $errors->first('last_name') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >gender<span style="color:red;">*</span></label>
                      <select name="gender" required class="form-control" id="">
                        <option value="">Select Gender</option>
                        <option {{ (old('gender',$getRecord->gender) =='Laki-Laki')?'selected':'' }} value="Laki-Laki">Laki-Laki</option>
                        <option {{ (old('gender',$getRecord->gender) =='Perempuan')?'selected':'' }} value="Perempuan">Perempuan</option>
                        <option {{ (old('gender',$getRecord->gender) =='Other')?'selected':'' }}  value="Other">Other</option>
                      </select>
                      <div style="color:red;">
                        {{ $errors->first('gender') }}
                    
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label >Tanggal Lahir<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" name="date_of_birth" required placeholder="Enter Tanggal Lahir">
                      <div style="color:red;">
                        {{ $errors->first('date_of_birth') }}
                    
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >Tanggal Gabung<span style="color:red;">*</span></label>
                      <input type="date" class="form-control" required value="{{ old('admission_date',$getRecord->admission_date) }}" name="admission_date" required placeholder="Enter Tanggal Lahir">
                      <div style="color:red;">
                        {{ $errors->first('admission_date') }}
                    
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Material Status<span style="color:red;">*</span></label>
                      <input type="text" class="form-control" required value="{{ old('material_status',$getRecord->material_status) }}" name="material_status" required placeholder="Enter Material Status">
                      <div style="color:red;">
                        {{ $errors->first('material_status') }}
                    
                    </div>
                    </div>

                   
                    <div class="form-group col-md-6">
                      <label>No Hp<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" required value="{{ old('mobile_number',$getRecord->mobile_number) }}" name="mobile_number" required placeholder="Enter Mobile Number">
                      <div style="color:red;">
                        {{ $errors->first('mobile_number') }}
                    
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                      <label >current_address<span style="color:red;">*</span></label>
                      <textarea name="address" class="form-control" >{{ old('address',$getRecord->address) }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('address') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >permanent_address<span style="color:red;">*</span></label>
                      <textarea name="permanent_address" class="form-control" >{{ old('permanent_address',$getRecord->permanent_address) }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('permanent_address') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >qualification<span style="color:red;">*</span></label>
                      <textarea name="qualification" class="form-control" >{{ old('qualification',$getRecord->qualification) }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('qualification') }}
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label >work_experience<span style="color:red;">*</span></label>
                      <textarea name="work_experience" class="form-control" >{{ old('work_experience',$getRecord->work_experience) }}</textarea>
                      <div style="color:red;">
                        {{ $errors->first('work_experience') }}
                    </div>
                    </div>
                
                   

                    <div class="form-group col-md-6">
                      <label >Profile picture<span style="color:red;">*</span></label>
                      <input type="file" class="form-control" name="profile_pic" >
                      <div style="color:red;">

                        {{ $errors->first('profile_pic') }}
                    
                    </div>
                    @if (!empty($getRecord->getProfile()))
                    <img src="{{ $getRecord->getProfile() }}" style="width: 100px" alt="">
                        
                    @endif
                    </div>
                  </div>

                
<hr>
                  <div class="form-group">
                    <label >Email<span style="color:red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email',$getRecord->email) }}" name="email" required placeholder="Enter email">
                    <div style="color:red;">
                        {{ $errors->first('email') }}
                    
                    </div>
                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
