@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Laporan Presensi Mahasiswa ({{ $getRecord->total() }})</h1> --}}
                </div>
                <div class="col-sm-6 text-right">
                    <h5> {{ $totalPresensi }} / {{ $totalMahasiswa }}</h5>
                </div>
            </div>
        </div>
    </section>


    @include('_message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="form-group col-md-3">
                                        <label>Semester</label>
                                        <select name="semester_id"  class="form-control getSemester"required>
                                            <option value="">Select</option>
                                            @foreach ($getSemester as $semester)
                                            <option {{ (Request::get('semester_id') == $semester->id) ? 'selected':'' }}  value="{{ $semester->id }}">{{ $semester->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kelas</label>
                                        <select name="class_id" id="getClass" class="form-control getClass"required>
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }}  value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Mata Kuliah</label>
                                        <select id="getMatkul" name="matkul_id" class="form-control getSubject"required>
                                            @if (!empty($getSubject))
                                                @foreach ($getSubject as $matkul)
                                                    <option {{ (Request::get('matkul_id') == $matkul->matkul_id) ? 'selected':'' }}  value="{{ $matkul->matkul_id }}">{{ $matkul->matkul_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                              
                                    <div class="form-group col-md-3">
                                        <label>Tanggal Presensi</label>
                                        <input type="date" id="getPresensiDate" value="{{ Request::get('tgl_presensi') }}" name="tgl_presensi" class="form-control"required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Nama Mahasiswa</label>
                                        <input type="text" name="student_name" value="{{ Request::get('student_name') }}" class="form-control" placeholder="Nama Mahasiswa">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('dosen/presensi/mahasiswa') }}" class="btn btn-success mt-4" type="submit">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="{{ url('dosen/presensi/report_excel') }}" style="float: right;">
                                {{ csrf_field() }}
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                <input type="hidden" name="matkul_id" value="{{ Request::get('matkul_id') }}">
                                <input type="hidden" name="tgl_presensi" value="{{ Request::get('tgl_presensi') }}">
                                <input type="hidden" name="presensi_type" value="{{ Request::get('presensi_type') }}">
                            </form>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Presensi</th>
                                            {{-- <th>Bobot Kehadiran</th> --}}
                                            <th>Tgl Presensi</th>
                                            <th>Foto</th>
                                            <th>Detail Izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse($getRecord as $value)
                                        <tr data-id="{{ $value->id }}">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->matkul_name }}</td>
                                            <td>
                                                @if ($value->presensi_type == 1) Hadir
                                                @elseif ($value->presensi_type == 2) Terlambat A
                                                @elseif ($value->presensi_type == 3) Terlambat B
                                                @elseif ($value->presensi_type == 4) Sakit
                                                @elseif ($value->presensi_type == 5) Izin
                                                @elseif ($value->presensi_type == 6) Tidak Hadir
                                                @endif
                                            </td>
                                            <td>{{ $value->bobot }} %</td>
                                            <td>{{ date('d-m-Y', strtotime($value->tgl_presensi)) }}</td>
                                            <td>
                                                @if (!empty($value->getProfilePresensi()))
                                                <img src="{{ $value->getProfilePresensi() }}" class="img-thumbnail" style="width: 50px; height: 50px; border-radius: 50px;" alt="">
                                              </td>
                                            @endif
                                            @if ($value->presensi_type == 4 || $value->presensi_type == 5)
                                            <td>
                                                <a href="{{ url('dosen/perizinan_detail/'.$value->id.'/'. $value->class_id.'/'.$value->matkul_id ) }}" class="btn btn-primary">Detail Perizinan</a>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="100%">Record not Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float:right;">
                                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <h5>Ringkasan Bobot Kehadiran</h5>
                            @php
                            $totalBobot = $getRecord->sum('bobot');
                            $jumlahRecord = $getRecord->count();
                            $averageBobot = $jumlahRecord ? round($totalBobot / $jumlahRecord, 2) : 0;
                            @endphp
                            <p>Rata-rata Bobot Kehadiran: {{ $averageBobot }} %</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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

    

    });
</script>
@endsection
