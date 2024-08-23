@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Kelas & Mata Kuliah </h1>
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
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Semester</label>
                                        <select name="semester_id"  class="form-control getSemester" required>
                                            <option value="">Select</option>
                                            @foreach ($getSemester as $semester)
                                            <option {{ (Request::get('semester_id') == $semester->id) ? 'selected':'' }}  value="{{ $semester->id }}">{{ $semester->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kelas</label>
                                        <select name="class_id" id="getClass" class="form-control getClass" required>
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Mata Kuliah</label>
                                        <select id="getMatkul" name="matkul_id" class="form-control getSubject" required>
                                            @if (!empty($getSubject))
                                                @foreach ($getSubject as $matkul)
                                                    <option {{ (Request::get('matkul_id') == $matkul->matkul_id) ? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Dosen</label>
                                        <select name="dosen_id" class="form-control getDosen" required>
                                            @if (!empty($getDosen))
                                                @foreach ($getDosen as $dosen)
                                                    <option {{ (Request::get('dosen_id') == $dosen->dosen_id) ? 'selected':'' }} value="{{ $dosen->dosen_id }}">{{ $dosen->dosen_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('dosen/class_timetable') }}" class="btn btn-success mt-4"
                                            type="submit">Clear</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    @if (!empty(Request::get('class_id')) && !empty(Request::get('matkul_id')))
                        <form id="timetableForm" action="{{ url('dosen/class_timetable/add') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="matkul_id" value="{{ Request::get('matkul_id') }}">
                            <input type="hidden" name="semester_id" value="{{ Request::get('semester_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <input type="hidden" name="dosen_id" value="{{ Request::get('dosen_id') }}">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Class TimeTable </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Status</th>
                                                    <th>Ruangan</th>
                                                    <th>Link Zoom</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Menit Mulai</th>
                                                    <th>Jam Akhir</th>
                                                    <th>Menit Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($week as $item)
                                                <tr data-week-name="{{ $item['week_name'] }}">
                                                    <th>
                                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $item['week_id'] }}">
                                                            {{ $item['week_name'] }}
                                                        </th>
                                                        <td>
                                                            <select name="timetable[{{ $i }}][status]" class="form-control statusSelect" data-index="{{ $i }}">
                                                            <option value="">Select</option>
                                                                <option value="Offline" {{ $item['status'] == 'Offline' ? 'selected' : '' }}>Offline</option>
                                                                <option value="Online" {{ $item['status'] == 'Online' ? 'selected' : '' }}>Online</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][room_number]" type="number" style="width: 100px; display: none;" class="form-control text-center roominput" data-index="{{ $i }}" id=""
                                                            value="{{ $item['room_number'] }}">
                                                        </td>
                                                        <td>
                                                            <textarea name="timetable[{{ $i }}][link]" class="form-control linkInput" data-index="{{ $i }}" style="display: none;">{{ $item['link'] }}</textarea>
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][tanggal]" type="date" style="width: 150px;" class="form-control text-center" id=""
                                                            value="{{ $item['tanggal'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][jam_mulai]" max="16" min="7" type="number" style="width: 100px;" class="form-control text-center jam_mulai" data-index="{{ $i }}" value="{{ $item['jam_mulai'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][menit_mulai]" max="60" min="0" type="number" style="width: 100px;" class="form-control text-center menit_mulai" data-index="{{ $i }}" value="{{ $item['menit_mulai'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][jam_akhir]" max="18" min="7" type="number" style="width: 100px;" class="form-control text-center jam_akhir" data-index="{{ $i }}" value="{{ $item['jam_akhir'] }}">
                                                        </td>
                                                        <td>
                                                            <input  name="timetable[{{ $i }}][menit_akhir]" max="60" min="0" type="number" style="width: 100px;" class="form-control text-center menit_akhir" data-index="{{ $i }}" value="{{ $item['menit_akhir'] }}">
                                                        </td>
                                                       
                                                        
                                                        <!-- Hidden start_time and end_time inputs -->
                                                        <input  name="timetable[{{ $i }}][start_time]" type="hidden" class="form-control text-center" id="start_time_{{ $i }}" value="">
                                                        <input  name="timetable[{{ $i }}][end_time]" type="hidden" class="form-control text-center" id="end_time_{{ $i }}" value="">
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div style="text-align: center; padding:20px;">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @endif

                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

@endsection

@section('script')

<script type="text/javascript">
 $(document).ready(function() {
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }

     // Initialize the visibility of inputs based on the current status value
     $('.statusSelect').each(function() {
         var index = $(this).data('index');
         var status = $(this).val();
         toggleFields(status, index);
     });

     // Toggle fields based on status change
     $('.statusSelect').change(function() {
         var index = $(this).data('index');
         var status = $(this).val();
         toggleFields(status, index);
     });

     function toggleFields(status, index) {
         if (status === 'Online') {
             $('.linkInput[data-index="'+index+'"]').show();
             $('.roominput[data-index="'+index+'"]').hide();
         } else if (status === 'Offline') {
             $('.roominput[data-index="'+index+'"]').show();
             $('.linkInput[data-index="'+index+'"]').hide();
         } else {
             $('.linkInput[data-index="'+index+'"]').hide();
             $('.roominput[data-index="'+index+'"]').hide();
         }
     }

 $('.getSemester').change(function() {
    var semester_id = $(this).val();
    var class_id = $('.getClass').val(); // Debugging class_id
    console.log("Semester ID:", semester_id);
    console.log("Class ID:", class_id);
    $.ajax({
        url: "{{ url('dosen/semester_class/get_semester') }}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            semester_id: semester_id,
            class_id: class_id // kirim class_id untuk diproses di server
        },
        dataType: "json",
        success: function(response) {
            $('.getClass').html(response.html);
        },
    });
});

       // Get Subjects based on selected Class
       $('#getClass').change(function() {
        var semester_id = $('.getSemester').val();
        var class_id = $(this).val();
        $.ajax({
            url: "{{ url('dosen/semester_class/get_semester_subject') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                semester_id: semester_id,
                class_id: class_id,
            },
            dataType: "json",
            success: function(response) {
                $('#getMatkul').html(response.html);
                $('.getDosen').html('<option value="">Pilih Dosen</option>');
            },
        });
    });

    // Get Dosen based on selected Subject
    $('#getMatkul').change(function() {
        var semester_id = $('.getSemester').val();
        var class_id = $('#getClass').val();
        var matkul_id = $(this).val();
        $.ajax({
            url: "{{ url('dosen/semester_class/get_dosen_subject') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                semester_id: semester_id,
                class_id: class_id,
                matkul_id: matkul_id,
            },
            dataType: "json",
            success: function(response) {
                $('.getDosen').html(response.html);
            },
        });
    });

     $('#deleteButton').click(function() {
         if(confirm('Are you sure you want to delete all entries?')) {
             $('#timetableForm').attr('action', '{{ url('dosen/class_timetable/delete') }}').submit();
         }
     });

     $('.jam_mulai, .menit_mulai, .jam_akhir, .menit_akhir').on('input', function() {
         var index = $(this).data('index');
         var jam_mulai = $('.jam_mulai[data-index="'+index+'"]').val().padStart(2, '0');
         var menit_mulai = $('.menit_mulai[data-index="'+index+'"]').val().padStart(2, '0');
         var jam_akhir = $('.jam_akhir[data-index="'+index+'"]').val().padStart(2, '0');
         var menit_akhir = $('.menit_akhir[data-index="'+index+'"]').val().padStart(2, '0');
         
         menit_mulai = menit_mulai === '0' ? '00' : menit_mulai;
         menit_akhir = menit_akhir === '0' ? '00' : menit_akhir;
         
         $('#start_time_' + index).val(jam_mulai + ':' + menit_mulai);
         $('#end_time_' + index).val(jam_akhir + ':' + menit_akhir);
     });

   // Form submission validation
  // Validasi waktu sebelum submit
  $('#timetableForm').on('submit', function(e) {
        var isValid = true;
        var errorMsg = "";

        $('.jam_mulai').each(function() {
            var index = $(this).data('index');
            var jamMulai = parseInt($(this).val());
            var menitMulai = parseInt($('.menit_mulai[data-index="' + index + '"]').val());
            var jamAkhir = parseInt($('.jam_akhir[data-index="' + index + '"]').val());
            var menitAkhir = parseInt($('.menit_akhir[data-index="' + index + '"]').val());

            var startTime = (jamMulai * 60) + menitMulai;
            var endTime = (jamAkhir * 60) + menitAkhir;

            // Validasi logika waktu
            if (startTime >= endTime) {
                isValid = false;
                errorMsg = "Waktu mulai harus lebih awal dari waktu akhir pada baris ke-" + index;
            }

            // Set hidden fields
            $('#start_time_' + index).val(jamMulai.toString().padStart(2, '0') + ":" + menitMulai.toString().padStart(2, '0'));
            $('#end_time_' + index).val(jamAkhir.toString().padStart(2, '0') + ":" + menitAkhir.toString().padStart(2, '0'));
        });

        if (!isValid) {
            alert(errorMsg);
            e.preventDefault(); // Mencegah form submit jika tidak valid
        } else {

            var weekNames = {
    2: "Senin",
    3: "Selasa",
    4: "Rabu",
    5: "Kamis",
    6: "Jumat",
};
            // Tampilkan notifikasi
            var matkulName = $("#getMatkul option:selected").text();
            var weekId = $("input[name='timetable[1][week_id]']").val();
            var weekName = weekNames[weekId];
            var startTime = $("input[name='timetable[1][start_time]']").val();
            var endTime = $("input[name='timetable[1][end_time]']").val();

            if (Notification.permission === "granted") {

                new Notification("Perubahan Jadwal", {
                    body: "Perubahan jadwal pada " + matkulName + " menjadi hari " + weekName + " jam " + startTime + " - " + endTime,
                    icon: "https://cdn-icons-png.flaticon.com/512/2922/2922506.png"
                });
            }
        }
    });

         
         $('.menit_mulai, .menit_akhir').each(function() {
             var menit = $(this).val();
             if (menit === '0') {
                 alert('Menit harus diisi dengan format 00, bukan 0.');
                 valid = false;
                 return false; // break out of each loop
             }
         });

         // Function to convert time to minutes
         function timeToMinutes(jam, menit) {
             return parseInt(jam) * 60 + parseInt(menit);
         }
         
         // Iterate through each row to validate time
         $('tr').each(function() {
             var index = $(this).find('.jam_mulai').data('index');
             var jam_mulai = parseInt($('.jam_mulai[data-index="'+index+'"]').val()) || 0;
             var menit_mulai = parseInt($('.menit_mulai[data-index="'+index+'"]').val()) || 0;
             var jam_akhir = parseInt($('.jam_akhir[data-index="'+index+'"]').val()) || 0;
             var menit_akhir = parseInt($('.menit_akhir[data-index="'+index+'"]').val()) || 0;

             var startTime = timeToMinutes(jam_mulai, menit_mulai);
             var endTime = timeToMinutes(jam_akhir, menit_akhir);

             if (startTime > endTime) {
                 alert('Jam mulai tidak boleh lebih besar dari jam akhir pada baris ' + index + '.');
                 valid = false;
                 return false; // break out of each loop
             }
             
         });

         if (!valid) {
             e.preventDefault(); // prevent form submission
         }
     });
 </script>

@endsection
