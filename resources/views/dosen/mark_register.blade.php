@extends('layouts.app')

@section('content')
    
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengelolaan Nilai</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Search Mark Register</h3>
                        </div> --}}
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Semester</label>
                                        <select name="exam_id" required class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($getExam as $exam)
                                                <option {{ (Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id }}">{{ $exam->kurikulum_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label>Kelas</label>
                                        <select name="class_id" required class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('dosen/mark_register') }}" class="btn btn-success mt-4">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /.card -->
                <div class="col-md-12">
                    @if(!empty($getMatkul) && !empty($getMatkul->count()))
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jadwal Ujian</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                @foreach ($getMatkul as $matkul)
                                                    <th>{{ $matkul->matkul_name }} 
                                                        ( {{ $matkul->matkul_type }} :  {{ $matkul->passing_mark }} / {{ $matkul->full_mark }} )
                                                    </th> 
                                                @endforeach
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($getStudent) && !empty($getStudent->count()))
                                                @foreach ($getStudent as $student)
                                                    <form class="submitForm" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                        <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                        <tr>
                                                            <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                            @php
                                                                $i = 1;
                                                                $totalStudentMark = 0;
                                                                $totalFullMark = 0;
                                                                $totalPassingMark = 0;
                                                                $pass_fail = 0;
                                                            @endphp
                                                            @foreach ($getMatkul as $matkul)
                                                                @php
                                                                    $totalMark = 0;
                                                                    $totalFullMark += $matkul->full_mark;
                                                                    $totalPassingMark += $matkul->passing_mark;
                                                                    $getMark = $matkul->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $matkul->matkul_id);
                                                                    if(!empty($getMark)) {
                                                                        $totalMark = $getMark->tugas + $getMark->praktikum + $getMark->uts + $getMark->uas;
                                                                    }
                                                                    $totalStudentMark += $totalMark;
                                                                @endphp
                                                                <td>
                                                                    <div>
                                                                        Tugas
                                                                        <input type="hidden" name="mark[{{ $i }}]['full_mark']" value="{{ $matkul->full_mark }}">
                                                                        <input type="hidden" name="mark[{{ $i }}]['passing_mark']" value="{{ $matkul->passing_mark }}">
                                                                        <input type="hidden" name="mark[{{ $i }}]['id']" value="{{ $matkul->id }}">
                                                                        <input type="hidden" name="mark[{{ $i }}]['matkul_id']" value="{{ $matkul->matkul_id }}">
                                                                        <input type="text" name="mark[{{ $i }}]['tugas']" id="tugas_{{ $student->id }}{{ $matkul->matkul_id }}" class="form-control" placeholder="Masukkan Nilai" value="{{ !empty($getMark->tugas) ? $getMark->tugas : '' }}">
                                                                        <br>
                                                                    </div>
                                                                    @if ($matkul->matkul_type == 'Teori & Praktikum')
                                                                        <div>
                                                                            Praktikum
                                                                            <input type="text" id="praktikum_{{ $student->id }}{{ $matkul->matkul_id }}" value="{{ !empty($getMark->praktikum) ? $getMark->praktikum : '' }}" name="mark[{{ $i }}]['praktikum']" class="form-control" placeholder="Masukkan Nilai">
                                                                            <br>
                                                                        </div>
                                                                    @endif
                                                                    <div>
                                                                        UTS
                                                                        <input type="text" id="uts_{{ $student->id }}{{ $matkul->matkul_id }}" value="{{ !empty($getMark->uts) ? $getMark->uts : '' }}" name="mark[{{ $i }}]['uts']" class="form-control" placeholder="Masukkan Nilai">
                                                                        <br>
                                                                    </div>
                                                                    <div>
                                                                        UAS
                                                                        <input type="text" id="uas_{{ $student->id }}{{ $matkul->matkul_id }}" value="{{ !empty($getMark->uas) ? $getMark->uas : '' }}" name="mark[{{ $i }}]['uas']" class="form-control" placeholder="Masukkan Nilai">
                                                                        <br>
                                                                    </div>
                                                                    <div>
                                                                        <button type="submit" class="btn btn-success SaveSingle" data-schedule="{{ $matkul->id }}" id="{{ $student->id }}" data-val="{{ $matkul->matkul_id }}" data-exam="{{ Request::get('exam_id') }}" data-class="{{ Request::get('class_id') }}">Save</button>
                                                                    </div>
                                                                    @if (!empty($getMark))
                                                                        <div>
                                                                            <b>Nilai Total : {{ $totalMark }}</b> <br>
                                                                            <b>Nilai KKM : {{ $matkul->passing_mark }}</b> <br>
                                                                            @php
                                                                                $getGradeLoop = App\Models\GradeModel::getGrade($totalMark);
                                                                            @endphp
                                                                            @if (!empty($getGradeLoop))
                                                                                <b>Grade : {{ $getGradeLoop }}</b>
                                                                            @endif
                                                                            @if ($totalMark >= $matkul->passing_mark)
                                                                                <p style="color: green">Lolos</p>
                                                                            @else
                                                                                <p style="color: red">Tidak Lolos</p>
                                                                                @php
                                                                                    $pass_fail = 1;
                                                                                @endphp
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            <td style="min-width: 250px">
                                                                {{-- <button type="submit" class="btn btn-primary submitForm">Save</button> --}}
                                                                @if (!empty($totalStudentMark))
                                                                    <br>
                                                                    Nilai Total Mahasiswa : {{ $totalStudentMark }}<br>
                                                                    Nilai Total Matkul : {{ $totalFullMark }}<br>
                                                                    Nilai Total Syarat Kelulusan : {{ $totalPassingMark }}<br>
                                                                    @php
                                                                        $percentage = ($totalStudentMark * 100) / $totalFullMark;
                                                                        $getGrade = App\Models\GradeModel::getGrade($percentage);
                                                                    @endphp
                                                                    <br>
                                                                    Persentasi Nilai : {{ round($percentage, 2) }}%<br>
                                                                    @if (!empty($getGrade))
                                                                        Grade : {{ $getGrade }}
                                                                    @else
                                                                        Grade : {{ '' }}
                                                                    @endif
                                                                    <br>
                                                                    @if ($pass_fail == 0)
                                                                        <p style="color: green">Lanjut Ke Semester Berikutnya</p>
                                                                    @else
                                                                        <p style="color: red">Tidak Lanjut</p>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('.SaveSingle').click(function(e) {
        e.preventDefault();
        var student_id = $(this).attr('id');
        var matkul_id = $(this).attr('data-val');
        var exam_id = $(this).attr('data-exam');
        var class_id = $(this).attr('data-class');
        var id = $(this).attr('data-schedule');

        var tugas = $('#tugas_'+student_id+matkul_id).val();
        var praktikum = $('#praktikum_'+student_id+matkul_id).val();
        var uts = $('#uts_'+student_id+matkul_id).val();
        var uas = $('#uas_'+student_id+matkul_id).val();
        $.ajax({
            type: "POST",
            url: "{{ url('dosen/single_submit_mark') }}",
            data: {
                '_token': "{{ csrf_token() }}",
                id : id,
                student_id: student_id,
                matkul_id: matkul_id,
                exam_id: exam_id,
                class_id: class_id,
                tugas: tugas,
                praktikum: praktikum,
                uts: uts,
                uas: uas,
            },
            dataType: "json",
            success: function(data) {
                alert(data.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection
