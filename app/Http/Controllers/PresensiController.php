<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\ClassTimeTableModel;
use App\Models\MatkulDosenModel;
use App\Models\PerizinanModel;
use App\Models\presensiModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Auth;
use Excel;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PresensiController extends Controller
{
    public function presensi_mahasiswa(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if (!empty($request->class_id)) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id);
        }
        if (!empty($request->get('class_id')) && !empty($request->get('tgl_presensi')) && !empty($request->get('matkul_id'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = "Presensi Mahasiswa ";

        return view('admin.presensi.mahasiswa', $data);
    }

    public function get_subject(Request $request)
    {
        $getSubject =  ClassMatkulModel::MySubject($request->class_id);
        $html = "<option value=''>Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->matkul_id . "'>" . $value->matkul_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function presensi_mahasiswa_save(Request $request)
    {
        $checkKehadiran = presensiModel::checkPresensi($request->student_id, $request->class_id, $request->tgl_presensi, $request->matkul_id, $request->week_id);
        if (!empty($checkKehadiran)) {
            $presensi = $checkKehadiran;
        } else {
            $presensi = new presensiModel;
            $presensi->student_id = $request->student_id;
            $presensi->matkul_id = $request->matkul_id;
            $presensi->class_id = $request->class_id;
            $presensi->week_id = $request->week_id;
            $presensi->tgl_presensi = $request->tgl_presensi;
            $presensi->created_by = Auth::user()->id;
        }
        $presensi->presensi_type = $request->presensi_type;
        $presensi->save();

        $json['message'] = 'Presensi Berhasil Disimpan';
        echo json_encode($json);
    }
    public function presensi_mahasiswa_self(Request $request)
    {
        $checkKehadiran = presensiModel::checkPresensi($request->student_id, $request->class_id, $request->tgl_presensi, $request->matkul_id, $request->week_id);
        if (!empty($checkKehadiran)) {
            $presensi = $checkKehadiran;
        } else {
            $presensi = new presensiModel;
            $presensi->student_id = $request->student_id;
            $presensi->matkul_id = $request->matkul_id;
            $presensi->class_id = $request->class_id;
            $presensi->tgl_presensi = $request->tgl_presensi;
            $presensi->created_by = Auth::user()->id;
        }
        $presensi->presensi_type = $request->presensi_type;
        $presensi->save();

        $json['message'] = 'Presensi Berhasil Disimpan';
        echo json_encode($json);
    }

    public function laporan_presensi()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getRecord'] = presensiModel::getRecord();
        $data['header_title'] = "Laporan Presensi Mahasiswa ";
        return view('admin.presensi.laporan', $data);
    }

    public function laporan_presensi_excel(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getRecord'] = presensiModel::getRecord();
        $data['header_title'] = "Laporan Presensi Mahasiswa ";
        return view('admin.presensi.laporan', $data);
    }

    public function presensi_mahasiswa_dosen(Request $request)
    {
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(FacadesAuth::user()->id);
        if (!empty($request->get('class_id')) && !empty($request->get('tgl_presensi'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        $data['header_title'] = "Presensi Mahasiswa ";
        return view('dosen.presensi.mahasiswa', $data);
    }

    public function laporan_presensi_dosen()
    {
        // $getClass = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        // $c = array();
        // foreach ($getClass as $val) {
        //     $c[] = $val->class_id;
        // }
        // $data['getClass'] = $getClass;
        // $data['getRecord'] = presensiModel::getRecordDosen($c);
        $data['header_title'] = "Laporan Presensi Mahasiswa ";
        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        // $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "My Presensi ";

        return view('dosen.presensi.laporan', $data);
    }

    public function MyPresensiStudent()
    {
        $data['perizinan'] = PerizinanModel::getRecord(Auth::user()->id);
        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Presensi ";

        return view('student.my_presensi', $data);
    }



    public function PresensiStudent($class_id, $matkul_id, $student_id, $week_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $data['getMahasiswa'] =  User::getSingle($student_id);
        $data['getDay'] =  WeekModel::getSingle($week_id);
        $data['getStudent'] = User::getStudentClass($class_id);
        // $data['getMyJadwal'] = $this->getJadwalStudent(Auth::user()->class_id);
        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubject($c->id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyJadwal'] = $result;


        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        // dd($data['getRecord']);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "My Presensi ";

        return view('student.presensi', $data);
    }
    public function PresensiDosen($class_id, $matkul_id, $student_id, $week_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $data['getMahasiswa'] =  User::getSingle($student_id);
        $data['getDay'] =  WeekModel::getSingle($week_id);
        $data['getStudent'] = User::getStudentClass($class_id);
        // $data['getMyJadwal'] = $this->getJadwalStudent(Auth::user()->class_id);
        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubject($c->id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyJadwal'] = $result;


        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        // dd($data['getRecord']);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "My Presensi ";

        return view('dosen.presensi.presensi', $data);
    }


    public function presensiStudentSave(Request $request)
    {
        // $student_id = $request->input('student_id');
        $student_id = Auth::user()->id;
        $class_id = $request->input('class_id');
        $matkul_id = $request->input('matkul_id');
        $week_id = $request->input('week_id');
        $presensi_type = $request->input('presensi_type');
        $tgl_presensi = now()->toDateString();

        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubject($c->id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject = ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $getMyJadwal = $result;

        // Assuming you have the necessary models imported
        $getClass = ClassModel::getSingle($class_id);
        $getMatkul = SubjectModel::getSingle($matkul_id);
        $getMahasiswa = User::getSingle($student_id);
        $getDay = WeekModel::getSingle($week_id);

        // Validate that the necessary models are found
        if (!$getMahasiswa || !$getClass || !$getMatkul || !$getDay) {
            $json['message'] = 'Invalid data provided';
            return response()->json($json, 400);
        }

        $checkKehadiran = presensiModel::checkPresensi($getMahasiswa->id, $getClass->id, now()->toDateString(), $getMatkul->id, $getDay->id);

        if (!empty($checkKehadiran)) {
            $presensi = $checkKehadiran;
        } else {
            if ($getDay->id != (now()->dayOfWeek + 1) % 7) {
                $json['message'] = "Anda hanya bisa melakukan presensi pada hari {$getDay->name}";
                return response()->json($json);
            } else {
                $classSchedule = $getMyJadwal[0]['week'][0];
                $current_time = now()->hour * 60 + now()->minute;
                $start_time = $classSchedule['jam_mulai'] * 60 + $classSchedule['menit_mulai'];
                $end_time = $classSchedule['jam_akhir'] * 60 + $classSchedule['menit_akhir'];

                if ($current_time < $start_time) {
                    $json['message'] = "Anda hanya bisa melakukan presensi pada jam {$classSchedule['jam_mulai']}";
                    return response()->json($json);
                }
                //  else if ($current_time > $end_time) {
                //     $json['message'] = 'Anda terlambat lebih dari 40 menit, harap lapor BAAK';
                //     return response()->json($json);
                // }
                else {
                    $presensi = new presensiModel;
                    $presensi->student_id = $getMahasiswa->id;
                    $presensi->matkul_id = $getMatkul->id;
                    $presensi->class_id = $getClass->id;
                    $presensi->tgl_presensi = $tgl_presensi;
                    $presensi->created_by = $getMahasiswa->name;
                    $presensi->created_at = now()->format('h:i A');

                    if ($current_time - $start_time > 30) {
                        $presensi->presensi_type = 6; // Tidak Hadir
                        $json['message'] = 'Anda terlambat lebih dari 30 menit, harap lapor BAAK';
                    } else if ($current_time - $start_time > 20) {
                        $presensi->presensi_type = 3; // Terlambat B
                        $json['message'] = 'Anda terlambat lebih dari 20 menit';
                    } else if ($current_time - $start_time > 15) {
                        $presensi->presensi_type = 2; // Terlambat A
                        $json['message'] = 'Anda terlambat lebih dari 15 menit';
                    } else {
                        $presensi->presensi_type = $presensi_type; // Hadir
                        $json['message'] = 'Anda Presensi tepat waktu';
                    }

                    $presensi->save();
                    return response()->json($json);
                }
            }
        }
    }
}
