<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\WeekModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassMatkulModel;
use App\Models\MatkulDosenModel;
use App\Models\SemesterClassModel;
use App\Models\ClassTimeTableModel;

class ClassTimeTableController extends Controller
{
    public function list(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = ClassModel::getClass();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        if (!empty($request->class_id && !empty($request->semester_id))) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
            // $data['getSubject'] =  ClassMatkulModel::SubjectSemester($request->semester_id, $request->class_id);;
        }
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $value) {
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if (!empty($request->class_id) && !empty($request->matkul_id)) {
                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($request->class_id, $request->matkul_id, $value->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                    $dataW['tanggal'] = '';
                    $dataW['jam_mulai'] = '';
                    $dataW['menit_mulai'] = '';
                    $dataW['jam_akhir'] = '';
                    $dataW['menit_akhir'] = '';
                    $dataW['status'] = '';
                    $dataW['link'] = '';
                }
            } else {

                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
                $dataW['tanggal'] = '';
                $dataW['jam_mulai'] = '';
                $dataW['menit_mulai'] = '';
                $dataW['jam_akhir'] = '';
                $dataW['menit_akhir'] = '';
                $dataW['status'] = '';
                $dataW['link'] = '';
            }
            $week[] = $dataW;
        }
        $data['week'] = $week;

        $data['header_title'] = "CLass Timetable";
        return view('admin.class_timetable.list', $data);
    }



    public function get_subject(Request $request)
    {
        $getSubject =  ClassMatkulModel::MySubjectMatkul($request->class_id);
        $html = "<option value=''>Select </option>";
        foreach ($getSubject as $value) {
            $html .= "<option value='" . $value->matkul_id . "'>" . $value->matkul_name . " </option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }

    public function get_subjects(Request $request)
    {
        $subjects = ClassMatkulModel::MySubjectMatkul($request->class_id);
        $subject_html = '<option value="">Select</option>';
        foreach ($subjects as $subject) {
            $subject_html .= '<option value="' . $subject->matkul_id . '">' . $subject->matkul_name . '</option>';
        }
        return response()->json(['subject_html' => $subject_html]);
    }
    public function get_semester(Request $request)
    {
        $class = SemesterClassModel::MySubjectSemester($request->semester_id);
        $html = "<option value=''>Select </option>";
        foreach ($class as $value) {
            $html .= '<option value="' . $value->class_id . '">' . $value->class_name . '</option>';
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
    public function get_semester_subject(Request $request)
    {
        $matkul = ClassMatkulModel::SubjectSemester($request->semester_id, $request->class_id);
        $html = "<option value=''>Select </option>";
        foreach ($matkul as $value) {
            $html .= '<option value="' . $value->matkul_id . '">' . $value->matkul_name . '</option>';
        }
        $json['html'] = $html;
        return response()->json($json); // gunakan response()->json() untuk mengembalikan JSON
    }




    public function get_dosen(Request $request)
    {
        // Pastikan class_id dan matkul_id ada
        if (!$request->has('class_id') || !$request->has('matkul_id')) {
            return response()->json(['dosen_html' => '<option value="">Select</option>']);
        }

        $dosenn = MatkulDosenModel::MySubjectDosen($request->class_id, $request->matkul_id);
        $dosen_html = '<option value="">Select</option>';

        foreach ($dosenn as $dosen) {
            $dosen_html .= '<option value="' . $dosen->id . '">' . $dosen->dosen_name . '</option>';
        }

        return response()->json(['dosen_html' => $dosen_html]);
    }


    public function insert_update(Request $request)
    {
        ClassTimeTableModel::where('class_id', '=', $request->class_id)->where('matkul_id', '=', $request->matkul_id)->where('semester_id', '=', $request->semester_id)->delete();
        foreach ($request->timetable as $timetable) {
            if (!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number']) && !empty($timetable['tanggal']) && !empty($timetable['jam_mulai']) && !empty($timetable['status']) && !empty($timetable['menit_mulai'])  && !empty($timetable['jam_akhir']) && !empty($timetable['menit_akhir'])) {
                $save = new ClassTimeTableModel;
                $save->class_id = $request->class_id;
                $save->matkul_id = $request->matkul_id;
                $save->semester_id = $request->semester_id;
                $save->week_id = $timetable['week_id'];
                $save->start_time = $timetable['start_time'];
                $save->end_time = $timetable['end_time'];
                $save->room_number = $timetable['room_number'];
                $save->tanggal = $timetable['tanggal'];
                $save->jam_mulai = $timetable['jam_mulai'];
                $save->menit_mulai = $timetable['menit_mulai'];
                $save->jam_akhir = $timetable['jam_akhir'];
                $save->menit_akhir = $timetable['menit_akhir'];
                $save->status = $timetable['status'];
                $save->link = $timetable['link'];
                $save->save();
            }
        }
        return redirect()->back()->with('success', 'Jadwal berhasil disimpan');
    }

    public function delete(Request $request)
    {
        ClassTimeTableModel::where('class_id', '=', $request->class_id)
            ->where('matkul_id', '=', $request->matkul_id)
            ->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }


    // student class
    public function myClassStudent()
    {
        $result = array();
        $getRecord = ClassMatkulModel::MySubject(Auth::user()->class_id, Auth::user()->semester_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_id'] = $valueW->id;
                $dataW['week_name'] = $valueW->name;
                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($value->class_id, $value->matkul_id, $valueW->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                } else {
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room_number'] = '';
                    $dataW['status'] = '';
                    $dataW['link'] = '';
                }
                $week[] = $dataW;
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }

        $data['getRecord'] = $result;
        $data['header_title'] = "My Class";
        return view('student.my_class', $data);
    }
    public function myClassDosen($class_id, $matkul_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;
            $classSubject =   ClassTimeTableModel::getRecordClassMatkul($class_id, $matkul_id, $valueW->id);
            if (!empty($classSubject)) {
                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['room_number'] = $classSubject->room_number;
                $dataW['status'] = $classSubject->status;
                $dataW['link'] = $classSubject->link;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
                $dataW['status'] = '';
                $dataW['link'] = '';
            }
            $result[] = $dataW;
        }

        $data['getRecord'] = $result;
        $data['header_title'] = "My Class";
        return view('dosen.my_timetable', $data);
    }


    // 
    public function myClassChild($class_id, $matkul_id, $student_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $data['getStudent'] =  User::getSingle($student_id);
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach ($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;
            $classSubject =   ClassTimeTableModel::getRecordClassMatkul($class_id, $matkul_id, $valueW->id);
            if (!empty($classSubject)) {
                $dataW['start_time'] = $classSubject->start_time;
                $dataW['end_time'] = $classSubject->end_time;
                $dataW['room_number'] = $classSubject->room_number;
                $dataW['status'] = $classSubject->status;
                $dataW['link'] = $classSubject->link;
            } else {
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
                $dataW['status'] = '';
                $dataW['link'] = '';
            }
            $result[] = $dataW;
        }

        $data['getRecord'] = $result;
        $data['header_title'] = "My Class";
        return view('ortu.my_timetable', $data);
    }
}
