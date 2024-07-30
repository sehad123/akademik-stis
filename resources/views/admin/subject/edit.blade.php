@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Matkul </h1>
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
              <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Nama Mata Kuliah</label>
                    <input type="text" value="{{  old('name',$getRecord->name)  }}" class="form-control" name="name" required placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label >Status</label>
                    <select name="status" class="form-control" id="">
                      <option value="0"{{ ($getRecord->status ==0) ? 'selected' :'' }}>Active </option>
                      <option value="1"{{ ($getRecord->status ==1) ? 'selected' :'' }}>Inactive </option>
                    </select>
                  </div>
                    
                  <div class="form-group">
                    <label >type</label>
                    <select name="type" class="form-control" id="">
                      <option value="Teori"{{ ($getRecord->type =='Teori') ? 'selected' :'' }}>Teori </option>
                      <option value="Teori & Praktikum"{{ ($getRecord->type =='Teori & Praktikum') ? 'selected' :'' }}>Teori & Praktikum </option>
                    </select>
                  
                    
                    </div>                  </div>
               
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
