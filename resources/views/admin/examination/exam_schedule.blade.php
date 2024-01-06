@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal Ujian </h1>
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
                <h3 class="card-title">Search Exam </h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label >Exam </label>
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
                      <a href="{{ url('admin/examinations/exam_schedule') }}" class="btn btn-success mt-4" type="submit">clear</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- /.card -->
          <div class="col-md-12">
            @if(!empty($getRecord))
            <form action="{{ url('admin/examinations/exam_schedule_insert') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
             
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Jadwal Ujian </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Matkul Name</th>
                        <th>Tanggal Ujian</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Ruangan</th>
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
                          <td>
                            <input type="date" name="schedule[{{ $i }}][exam_date]"   value="{{ $item['exam_date'] }}" class="form-control">
                          </td>
                          <td>
                            <input type="time"  name="schedule[{{ $i }}][start_time]" value="{{ $item['start_time'] }}" class="form-control">
                          </td>
                          <td>
                            <input type="time" name="schedule[{{ $i }}][end_time]" value="{{ $item['end_time'] }}" class="form-control">
                          </td>
                          <td>
                            <input type="text" name="schedule[{{ $i }}][room_number]"  value="{{ $item['room_number'] }}"class="form-control">
                          </td>
                          <td>
                            <input type="text" name="schedule[{{ $i }}][full_mark]"  value="{{ $item['full_mark'] }}"class="form-control">
                          </td>
                          <td>
                            <input type="text" name="schedule[{{ $i }}][passing_mark]"  value="{{ $item['passing_mark'] }}"class="form-control">
                          </td>
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
