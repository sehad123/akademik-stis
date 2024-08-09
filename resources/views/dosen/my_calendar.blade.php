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
        events.push({
            title: '{{ $value->matkul_name }}',
            daysOfWeek: [{{$value->fullcalendar_day }}], // Adjust as needed
            startTime: '{{ $value->start_time }}', // Adjust as needed
            endTime: '{{ $value->end_time }}', // Adjust as needed
            extendedProps: {
                className: '{{ $value->class_name }}',
                roomNumber: '{{ $value->room_number }}',
                status: '{{ $value->status }}'
            },
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
        initialView: 'timeGridWeek',
        eventContent: function(arg) {
            var matkulName = arg.event.title;
            var className = arg.event.extendedProps.className;
            var startTime = arg.event.startStr.split('T')[1].slice(0, 5);
            var endTime = arg.event.endStr.split('T')[1].slice(0, 5);
            var roomNumber = arg.event.extendedProps.roomNumber;
            var status = arg.event.extendedProps.status;

            var customHtml = `
                <div>
                    <b>${matkulName}</b><br>
                    ${className}<br>
                    ${startTime} - ${endTime}<br>
                    ${status === 'Online' ? '' : 'Ruangan : ' + roomNumber + '<br>'}
                   <b> ${status}<b>
                </div>
            `;
            return { html: customHtml };
        }
    });

    calendar.render();
</script>
@endsection
