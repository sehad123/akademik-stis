@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Grade </h1>
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
           
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Grade Exam</label>
                    <input type="text" value="{{  old('name',$getRecord->name)  }}" class="form-control" name="name" required placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label >Percent_From </label>
                    <input type="text" value="{{  old('percent_from',$getRecord->percent_from)  }}" class="form-control" name="percent_from" required placeholder="Enter percent_from">
                  </div>
                  <div class="form-group">
                    <label >Percent_To</label>
                    <input type="text" value="{{  old('percent_to',$getRecord->percent_to)  }}" class="form-control" name="percent_to" required placeholder="Enter percent_to">
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
