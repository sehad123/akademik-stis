@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cek Kurikulum </h1>
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
            <!-- general form elements -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Search Semester </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label >Semester </label>
                      <select name="exam_id" required id="" class="form-control">
                          <option value="">Select</option>
                          @foreach ($getExam as $exam)
                          <option {{ (Request::get('exam_id') == $exam->id)?'selected':'' }}  value="{{ $exam->id }}">{{ $exam->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label >Class </label>
                      <select name="class_id" required id="" class="form-control">
                          <option value="">Select</option>
                          @foreach ($getClass as $class)
                          <option {{ (Request::get('class_id') == $class->id)?'selected':''  }} value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <button class="btn btn-primary mt-4" type="submit">Search</button>
                      <a href="{{ url('admin/penilaian/list') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- /.card -->
          <div class="col-md-12">
            @if(!empty($getRecord))
            <form action="{{ url('admin/penilaian/penilaian_insert') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
             
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Semester </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Matkul Name</th>
                        <th>Full Marks</th>
                        <th>Passing Marks</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                      @foreach ($getRecord as $item)
                        <tr>
                          <td>{{ $item['matkul_name'] }}
                            <input type="hidden" name="schedule[{{ $i }}][matkul_id]" value="{{ $item['matkul_id'] }}" class="form-control">
                        </td>
                          @if ($item['matkul_type'] == 'Teori & Praktikum')
                          <td>
                            <input readonly type="text" name="schedule[{{ $i }}][full_mark]"  value="400"class="form-control">
                          </td>
                          <td>
                            <input readonly type="text" name="schedule[{{ $i }}][passing_mark]"  value="275"class="form-control">
                          </td>   
                          @else
                          <td>
                            <input readonly type="text" name="schedule[{{ $i }}][full_mark]"  value="300"class="form-control">
                          </td>
                          <td>
                            <input readonly type="text" name="schedule[{{ $i }}][passing_mark]"  value="225"class="form-control">
                          </td>   
                          @endif
                        
                        </tr>
                        @php
                            $i++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                  <div style="text-align: center; padding:20px">
                    <button class="btn btn-primary">Submit</button>
                </div>
                </div>
                <!-- /.card-body -->
              </div>
            </form>
            @endif
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
