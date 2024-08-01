@extends('layouts.app')
@section('style')
<style type="text/css">
.fc-daygrid-event {
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
                    <h1>Jadwal Saya</h1>
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
<script src="{{ url('public/dist/fullcalendar/index.global.js') }}"></script>
<script type="text/javascript">
    var events = [];

    // jadwal harian
    @foreach($getMyJadwal as $value)
        @foreach($value['week'] as $week)
            events.push({
                title: '{{ $value['name'] }}',
                daysOfWeek: [{{ $week['fullcalendar_day'] }}],
                startTime: '{{ $week['start_time'] }}',
                endTime: '{{ $week['end_time'] }}',
                extendedProps: {
                    className: '{{ $value['class_name'] }}',
                    roomNumber: '{{ $week['room_number'] }}'
                },
                url: "{{ url('http://localhost:85/akademik.stis/student/presensi') }}" + '/' + {{ $week['class_id'] }} + '/' + {{ $week['matkul_id'] }} + '/' + {{ $week['student_id'] }} + '/' + {{ $week['week_id'] }},
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
        initialView: 'timeGridWeek',
        eventContent: function(arg) {
            var matkulName = arg.event.title;
            var className = arg.event.extendedProps.className;
            var startTime = arg.event.startStr.split('T')[1].slice(0, 5);
            var endTime = arg.event.endStr.split('T')[1].slice(0, 5);
            var roomNumber = arg.event.extendedProps.roomNumber;

            var customHtml = `
                <div>
                    <b>${matkulName}</b><br>
                    ${className}<br>
                    ${startTime} - ${endTime}<br>
                    Ruangan : ${roomNumber}
                </div>
            `;
            return { html: customHtml };
        }
    });

    calendar.render();
</script>
@endsection
