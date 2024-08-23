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
        $data['getDosen'] = ExamModel::getSemester();

        // $data['getClass'] = ClassModel::getClass();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        if (!empty($request->class_id && !empty($request->semester_id))) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
            // $data['getSubject'] =  ClassMatkulModel::SubjectSemester($request->semester_id, $request->class_id);;
        }

        if (!empty($request->class_id && !empty($request->semester_id)) && !empty($request->matkul_id)) {
            $data['getDosen'] = MatkulDosenModel::getDosenMatkul($request->class_id, $request->semester_id, $request->matkul_id);
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

    public function jadwal_dosen(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();
        $data['getDosen'] = ExamModel::getSemester();

        // $data['getClass'] = ClassModel::getClass();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        if (!empty($request->class_id && !empty($request->semester_id))) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
            // $data['getSubject'] =  ClassMatkulModel::SubjectSemester($request->semester_id, $request->class_id);;
        }

        if (!empty($request->class_id && !empty($request->semester_id)) && !empty($request->matkul_id)) {
            $data['getDosen'] = MatkulDosenModel::getDosenMatkul($request->class_id, $request->semester_id, $request->matkul_id);
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
        return view('dosen.jadwal_dosen', $data);
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
    public function get_dosen_subject(Request $request)
    {
        $dosen = MatkulDosenModel::getDosenMatkul($request->class_id, $request->semester_id, $request->matkul_id);
        $html = "<option value=''>Select </option>";
        foreach ($dosen as $value) {
            $html .= '<option value="' . $value->dosen_id . '">' . $value->dosen_name . '</option>';
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
        // Log request input

        $messages = [];
        $hasConflict = false;

        foreach ($request->timetable as $timetable) {
            $isOffline = $timetable['status'] == 'Offline';

            // Mengatur nilai default jika kolom kosong dengan NULL
            $menit_mulai = !empty($timetable['menit_mulai']) ? $timetable['menit_mulai'] : null;
            $menit_akhir = !empty($timetable['menit_akhir']) ? $timetable['menit_akhir'] : null;
            $room_number = $isOffline ? (!empty($timetable['room_number']) ? $timetable['room_number'] : null) : null;

            // Cek apakah ada entri dengan waktu yang sama
            $conflict = ClassTimeTableModel::where('class_id', '=', $request->class_id)
                ->where('week_id', '=', $timetable['week_id'])
                // ->where('dosen_id', '=', $timetable['dosen_id'])
                ->where('tanggal', '=', $timetable['tanggal'])
                ->where('jam_mulai', '=', $timetable['jam_mulai'])
                ->where('menit_mulai', '=', $menit_mulai)
                ->where('jam_akhir', '=', $timetable['jam_akhir'])
                ->where('menit_akhir', '=', $menit_akhir)
                ->where(function ($query) use ($request) {
                    // Tidak memeriksa jadwal untuk mata kuliah yang sama
                    $query->where('matkul_id', '!=', $request->matkul_id);
                })
                ->exists();

            if ($conflict) {
                $messages[] = "Conflict detected for Week ID: {$timetable['week_id']} on {$timetable['tanggal']} from {$timetable['jam_mulai']}:{$menit_mulai} to {$timetable['jam_akhir']}:{$menit_akhir}.";
                $hasConflict = true;
            } else {
                // Validasi entri yang ada atau buat entri baru
                $existing = ClassTimeTableModel::where('class_id', '=', $request->class_id)
                    ->where('matkul_id', '=', $request->matkul_id)
                    ->where('semester_id', '=', $request->semester_id)
                    ->where('dosen_id', '=', $request->dosen_id)
                    ->where('week_id', '=', $timetable['week_id'])
                    ->first();

                if ($existing) {
                    // Update existing entry
                    $existing->start_time = $timetable['start_time'] ?? null;
                    $existing->end_time = $timetable['end_time'] ?? null;
                    $existing->room_number = $room_number;
                    $existing->tanggal = $timetable['tanggal'] ?? null;
                    $existing->jam_mulai = $timetable['jam_mulai'] ?? null;
                    $existing->menit_mulai = $menit_mulai;
                    $existing->jam_akhir = $timetable['jam_akhir'] ?? null;
                    $existing->menit_akhir = $menit_akhir;
                    $existing->status = $timetable['status'] ?? null;
                    $existing->link = $timetable['link'] ?? null;
                    $existing->save();
                } else {
                    // Insert new entry
                    $save = new ClassTimeTableModel;
                    $save->class_id = $request->class_id;
                    $save->matkul_id = $request->matkul_id;
                    $save->semester_id = $request->semester_id;
                    $save->dosen_id = $timetable['dosen_id'] ?? $request->dosen_id; // Menggunakan dosen_id dari timetable atau request
                    $save->week_id = $timetable['week_id'];
                    $save->start_time = $timetable['start_time'] ?? null;
                    $save->end_time = $timetable['end_time'] ?? null;
                    $save->room_number = $room_number;
                    $save->tanggal = $timetable['tanggal'] ?? null;
                    $save->jam_mulai = $timetable['jam_mulai'] ?? null;
                    $save->menit_mulai = $menit_mulai;
                    $save->jam_akhir = $timetable['jam_akhir'] ?? null;
                    $save->menit_akhir = $menit_akhir;
                    $save->status = $timetable['status'] ?? null;
                    $save->link = $timetable['link'] ?? null;
                    $save->save();
                }
            }
        }

        // Menetapkan pesan ke session berdasarkan apakah ada konflik
        if ($hasConflict) {
            // $message = implode(' ', $messages); // Gabungkan semua pesan error
            // return redirect()->back()->with('info', "maaf jadwal diisi dengan mata kuliah lain");
            return redirect()->back()->with('success', 'Jadwal berhasil disimpan');
        }

        // Menetapkan pesan sukses jika tidak ada konflik
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
