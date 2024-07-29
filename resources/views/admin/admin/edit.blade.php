@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Admin </h1>
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
                  <div class="form-group">
                    <label >Name</label>
                    <input type="text" value="{{  old('name',$getRecord->name)  }}" class="form-control" name="name" required placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" value="{{ old('email',$getRecord->email)  }}" class="form-control" name="email" required placeholder="Enter email">
                    <div style="color:red;">
                        {{ $errors->first('email') }}
                    
                    </div>                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="text" class="form-control" name="password"  placeholder="Password">
                    <p>please add new password if you want change password</p>
                  </div>
                </div>
                
                <div class="form-group">
                  <label >Profile picture<span style="color:red;">*</span></label>
                  <input type="file" class="form-control" name="profile_pic" >
                  <div style="color:red;">
                    {{ $errors->first('profile_pic') }}
                </div>
                @if (!empty($getRecord->getProfile()))
                <img src="{{ $getRecord->getProfile() }}" style="width: 100px" alt="">
                @endif
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
