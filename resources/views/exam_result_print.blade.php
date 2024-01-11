<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Nilai </title>
    <style>
        @page{
            size: 8.3in 11.7in;
        }
        @page{
            size: A4;
        }
        .margin-bottom
        {
            margin-bottom: 3px;
        }
        .table-bg {
            border-collapse: collapse;
            width: 70%;
            margin-left: 50px;
            font-size: 15px;
            text-align: center;
        }
        .th{
            border: 1px solid #000;
            padding: 3px;
        }
        .td{
            border: 1px solid #000;
            padding: 3px;
        }
        .text-container{
            text-align: left;
            padding-left: 5px;
        }
        @media print{
            @page{
                margin:0px;
                margin-left: 20px;
                margin-right: 20px;
            }
        }
    </style>
</head>
<body>
    <div id="page">
        <table style="width:100%; text-align:center;">
            <tr>
                <td width="5%"></td>
                <td>
                    {{-- <img width="100" height="200" src="https://upload.wikimedia.org/wikipedia/commons/2/2d/Lambang_Politeknik_Statistika_STIS.png" alt=""> --}}
                 </td>
                <td>
                    <h1>Seklolah Tinggi Ilmu Statistik</h1>
                </td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td width="5%"></td>
                <td width="70%">
                    <table class="margin-bottom" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="23%">Nama :</td>
                                    <td style="border-bottom: 1px solid; width:100%">{{ $getStudent->first_name }} {{ $getStudent->last_name }}</td>
                                </tr>
                            </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="23%">NIM :</td>
                                    <td style="border-bottom: 1px solid; width:100%"> {{ $getStudent->admission_number }}</td>
                                </tr>
                            </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="23%">Kelas :</td>
                                    <td style="border-bottom: 1px solid; width:100%"> {{ $getClass->class_name }}</td>
                                </tr>
                            </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td width="23%">Tahun Ajaran  :</td>
                                    <td style="border-bottom: 1px solid; width:100%">{{ $getExam->name }} </td>
                               </tr>
                            </tbody>
                    </table>

                </td>
                <td width="5%"></td>
                <td width="20%" align="top">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2d/Lambang_Politeknik_Statistika_STIS.png" style="border-radius: 6px;" height="100px" width="100px" alt="">
                </td>
            </tr>

        </table>
        <br>
        <div >
            <table class="table-bg">
                <thead>
                    <tr>
                        <th class="th" >Matkul Name</th>
                        <th class="th">Matkul_type </th>
                        <th class="th">Tugas</th>
                        <th class="th">Praktikum</th>
                        <th class="th">UTS</th>
                        <th class="th">UAS</th>
                        <th class="th">Total_Score</th>
                        {{-- <th>Nilai KKM</th> --}}
                        {{-- <th>Nilai Full</th> --}}
                        <th class="th">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_score = 0;
                    $full_mark = 0;
                    $result_validation = 0;
                        $nomor = 1;
                    @endphp
                       @foreach ($getNilai as $exam)
                       @php
                       $percent = ($exam['total_score'] * 100)/$exam['full_mark'];
                     $Grade = App\Models\GradeModel::getGrade($percent);
                   @endphp
                       @php
                           $total_score = $total_score + $exam['total_score'];
                           $full_mark = $full_mark + $exam['full_mark'];
                       @endphp
                    <tr>
                        <td  class="td text-container" style="width: 300px;">{{ $exam['matkul_name'] }}</td>
                        <td class="td text-container" >{{ $exam['matkul_type'] }}</td>
                        <td class="td text-container" >{{ $exam['tugas'] }}</td>
                        @if ($exam['matkul_type'] == 'Teori & Praktikum')
                        <td class="td text-container">{{ $exam['praktikum'] }}</td>
                            @else
                            <td class="td text-container"> - </td>
                        @endif
                        <td class="td text-container" >{{ $exam['uts'] }}</td>
                        <td class="td text-container" >{{ $exam['uas'] }}</td>
                        <td class="td text-container" >{{ $exam['total_score'] }}</td>
                       
                        {{-- <td>{{ $exam['passing_mark'] }}</td> --}}
                        {{-- <td>{{ $exam['full_mark'] }}</td> --}}
                        <td class="td text-container" >{{ $Grade }}</td>
                        {{-- <td class="td text-container" >
                            @if ($exam['total_score'] >= $exam['passing_mark'])
                            <p style="color: green; font-weight:bold">Pass</p>
                            @else
                            @php
                                $resul_validation = 1;
                            @endphp
                            <p style="color: red; font-weight:bold">Fail</p>
                            @endif
                        </td> --}}
                    </tr>
                   
                @endforeach
                </tbody>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td width="5%"></td>
                    <td width="70%">
                        <table class="margin-bottom" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td >
                                            @php
                                                $percentage = ($total_score * 100)/$full_mark;
                                              $getGrade = App\Models\GradeModel::getGrade($percentage);
                                            @endphp
                                            <b> Total Keseluruhan : {{ $total_score }} / {{ $full_mark }}</b> 
                                        </td>
                                     </tr>
                                </tbody>
                        </table>
                        <table class="margin-bottom" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td >
                                            <b> IP  : {{$percentage*0 +3.15 }} </b> 
                                        </td>  </tr>
                                </tbody>
                        </table>
                        <table class="margin-bottom" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td >
                                            <b> Grade  : {{$getGrade }} </b> 
                                        </td> </tr>
                                </tbody>
                        </table>
                        <table class="margin-bottom" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td >
                                            Status :
                                            @if ($result_validation == 0)
                                            <b style="color: green"> Lolos </b>
                                            @else
                                            <b style="color: red"> Tidak Lolos  </b>
                                            @endif
                                            
                                    </td>  </tr>
                                </tbody>
                        </table>
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript">
    window.print();
    </script>
</body>
</html>