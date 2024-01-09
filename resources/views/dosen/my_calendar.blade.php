@extends('layouts.app')
@section('style')
<style type="text/css">

.fc-daygrid-event{
    white-space: normal;
}
</style>  
@endsection

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Calendar</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('script')
<script  src="{{ url('public/dist/fullcalendar/index.global.js') }}"></script>
<script type="text/javascript">
    var events = [];

    // jadwal harian
    @foreach($getMyJadwal as $value)
            events.push({
                title: '{{ $value->class_name }} - {{ $value->matkul_name }}',
                daysOfWeek: [{{$value->fullcalendar_day  }}], // Adjust as needed
                startTime: '{{ $value->start_time }}', // Adjust as needed
                endTime: '{{ $value->end_time }}', // Adjust as needed
                // url: "{{ url('http://localhost:85/akademik.stis/dosen/presensi') }}" + '/' + {{ $value['class_id'] }} + '/' + {{ $value['matkul_id'] }} + '/' + {{ $value['dosen_id'] }} + '/' + {{ $value['week_id'] }},
                url: "{{ url('http://localhost:85/akademik.stis/dosen/presensi') }}" + '/' + {{ $value['class_id'] }} + '/' + {{ $value['matkul_id'] }} + '/' + {{ Auth::user()->id }} + '/' + {{ $value['week_id'] }},

            });
    @endforeach

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: new Date(),
        navLinks: true,
        editable: false,
        events: events,
        initialView:'timeGridWeek',
    });

    calendar.render();
</script>
@endsection
