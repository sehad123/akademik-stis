@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Ujian ({{ $getStudent->name }} {{ $getStudent->last_name }})</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($getRecord as $value)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">{{ $value['exam_name'] }} </h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <th>Type</th>
                                        <th>Tugas</th>
                                        <th>Praktikum</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Total Score</th>
                                        <th>Nilai KKM</th>
                                        <th>Nilai Full</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_score = 0;
                                    $full_mark = 0;
                                    $result_validation = 0;
                                    $nomor = 1;
                                    @endphp
                                    @foreach ($value['matkul'] as $exam)
                                    @php
                                    $total_score = $total_score + $exam['total_score'];
                                    $full_mark = $full_mark + $exam['full_mark'];
                                    @endphp
                                    <tr>
                                        <td style="width: 300px;">{{ $exam['matkul_name'] }}</td>
                                        <td>{{ $exam['matkul_type'] }}</td>
                                        <td>{{ $exam['tugas'] }}</td>
                                        @if ($exam['matkul_type'] == 'Teori & Praktikum')
                                        <td>{{ $exam['praktikum'] }}</td>
                                        @else
                                        <td> - </td>
                                        @endif
                                        <td>{{ $exam['uts'] }}</td>
                                        <td>{{ $exam['uas'] }}</td>
                                        <td>{{ $exam['total_score'] }}</td>
                                        <td>{{ $exam['passing_mark'] }}</td>
                                        <td>{{ $exam['full_mark'] }}</td>
                                        <td>
                                            @if ($exam['total_score'] >= $exam['passing_mark'])
                                            <p style="color: green; font-weight: bold">Pass</p>
                                            @else
                                            @php
                                                $result_validation = 1;
                                            @endphp
                                            <p style="color: red; font-weight: bold">Fail</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            @php
                                            $percentage = ($total_score * 100) / $full_mark;

                                            // Convert percentage to IP
                                            $ip = 0;
                                            if ($percentage >= 85) {
                                                $ip = 4.0;
                                            } elseif ($percentage >= 75) {
                                                $ip = 3.5;
                                            } elseif ($percentage >= 65) {
                                                $ip = 3.0;
                                            } elseif ($percentage >= 55) {
                                                $ip = 2.5;
                                            } elseif ($percentage >= 45) {
                                                $ip = 2.0;
                                            } elseif ($percentage >= 35) {
                                                $ip = 1.0;
                                            } else {
                                                $ip = 0.0;
                                            }
                                            @endphp
                                            <b>Total Keseluruhan: {{ $total_score }} / {{ $full_mark }}</b>
                                        </td>
                                        <td colspan="2">
                                            <b>IP: {{ round($ip, 2) }}</b>
                                        </td>
                                        <td colspan="2">
                                            <b>Grade: 
                                                @if ($ip >= 3.5)
                                                    A
                                                @elseif ($ip >= 3.0)
                                                    B+
                                                @elseif ($ip >= 2.5)
                                                    B
                                                @elseif ($ip >= 2.0)
                                                    C+
                                                @elseif ($ip >= 1.0)
                                                    C
                                                @else
                                                    D
                                                @endif
                                            </b>
                                        </td>
                                        <td colspan="3">
                                            @if ($result_validation == 0)
                                            <b style="color: green">Lolos</b>
                                            @else
                                            <b style="color: red">Tidak Lolos</b>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection
