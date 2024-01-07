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
            <h1>My Calendar ( {{ $getStudent->name }}  {{ $getStudent->last_name }} )</h1>
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
        @foreach($value['week'] as $week)
            events.push({
                title: '{{ $value['name'] }}',
                daysOfWeek: [{{$week['fullcalendar_day']  }}], // Adjust as needed
                startTime: '{{ $week['start_time'] }}', // Adjust as needed
                endTime: '{{ $week['end_time'] }}', // Adjust as needed
            });
        @endforeach
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
