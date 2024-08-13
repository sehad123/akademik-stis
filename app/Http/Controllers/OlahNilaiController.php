<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\GradeModel;
use App\Models\NilaiModel;
use Illuminate\Http\Request;
use App\Models\OlahNilaiModel;
use App\Models\ClassMatkulModel;
use App\Models\MatkulDosenModel;
use App\Models\ExamScheduleModel;
use App\Models\SemesterClassModel;

class OlahNilaiController extends Controller
{
    public function olah_nilai(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = ClassModel::getClass();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);

        $result = array();
        if (!empty($request->get('semester_id')) && !empty($request->get('class_id'))) {
            $getMatkul = ClassMatkulModel::SubjectSemester($request->get('semester_id'), $request->get('class_id'));
            foreach ($getMatkul as $value) {
                $dataS = array();
                $dataS['semester_id'] = $value->semester_id;
                $dataS['matkul_id'] = $value->matkul_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['matkul_name'] = $value->matkul_name;
                $dataS['matkul_type'] = $value->matkul_type;
                $ExamSchedule = OlahNilaiModel::getRecordSingle($request->get('semester_id'), $request->get('class_id'), $value->matkul_id);

                if (!empty($ExamSchedule)) {
                    $dataS['full_mark'] = $ExamSchedule->full_mark;
                    $dataS['passing_mark'] = $ExamSchedule->passing_mark;
                } else {
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                }
                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;

        $data['header_title'] = "Pengolahan Nilai";

        return view('admin.penilaian.olah_nilai', $data);
    }

    // admin side
    public function nilai_insert(Request $request)
    {
        OlahNilaiModel::deleteRecord($request->semester_id, $request->class_id);

        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['matkul_id']) && !empty($schedule['full_mark']) && !empty($schedule['passing_mark'])) {
                    $exam = new OlahNilaiModel;
                    $exam->semester_id = $request->semester_id;
                    $exam->class_id = $request->class_id;
                    $exam->matkul_id = $schedule['matkul_id'];
                    $exam->full_mark = $schedule['full_mark'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with('info', "Nilai Berhasil ditetapkan");
    }

    public function mark_register(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = ClassModel::getClass();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);


        if (!empty($request->get('semester_id')) && !empty($request->get('class_id'))) {
            $data['getMatkul'] =  OlahNilaiModel::getSubject($request->get('semester_id'), $request->get('class_id'));
            // $data['getStudent'] =  User::getStudentClass($request->get('class_id'));
            $data['getStudent'] =  User::getClassStudent($request->get('class_id'));
        }

        $data['header_title'] = "Mark Register";
        return view('admin.penilaian.pengolahan_nilai', $data);
    }
    public function mark_register_dosen(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        // $data['getSemester'] = OlahNilaiModel::getExamDosen(Auth::user()->id);


        if (!empty($request->get('semester_id')) && !empty($request->get('class_id'))) {
            $data['getMatkul'] =  OlahNilaiModel::getSubject($request->get('semester_id'), $request->get('class_id'));
            // $data['getStudent'] =  User::getStudentClass($request->get('class_id'));
            $data['getStudent'] =  User::getClassStudent($request->get('class_id'));
            // dd($data['getStudent']);
        }

        $data['header_title'] = "Pengelolaan Nilai";
        return view('dosen.mark_register', $data);
    }

    public function single_submit_nilai(Request $request)
    {
        $id = $request->id;
        $getExam = OlahNilaiModel::getSingle($id);

        $full_mark = $getExam->full_mark;
        $tugas = !empty($request->tugas) ? $request->tugas : 0;
        $praktikum = !empty($request->praktikum) ? $request->praktikum : 0;
        $uts = !empty($request->uts) ? $request->uts : 0;
        $uas = !empty($request->uas) ? $request->uas : 0;

        $full_marks = !empty($request->full_mark) ? $request->full_mark : 0;
        $passing_mark = !empty($request->passing_mark) ? $request->passing_mark : 0;


        $total_mark = $tugas + $praktikum + $uas + $uts;
        if ($full_mark >= $total_mark) {
            $getMark = NilaiModel::CheckAlreadyMark($request->student_id, $request->semester_id, $request->class_id, $request->matkul_id);
            if (!empty($getMark)) {
                $save = $getMark;
            } else {
                $save = new NilaiModel;
                $save->created_by = Auth::user()->id;
            }
            $save->student_id = $request->student_id;
            $save->semester_id = $request->semester_id;
            $save->class_id = $request->class_id;
            $save->matkul_id = $request->matkul_id;
            $save->tugas = $tugas;
            $save->praktikum = $praktikum;
            $save->uts = $uts;
            $save->uas = $uas;
            // $save->full_mark = $full_mark;
            // $save->passing_mark = $passing_mark;
            $save->full_mark = $getExam->full_mark;
            $save->passing_mark = $getExam->passing_mark;
            $save->save();

            $json['message'] = "Nilai berhasil disimpan";
            // Menggunakan response()->json untuk memberikan respons JSON
            return response()->json($json);
        } else {
            $json['message'] = "Nilai total > nilai full";
            // Menggunakan response()->json untuk memberikan respons JSON
            return response()->json($json);
        }
    }

    // student side
    public function ExamStudent()
    {
        $class_id = Auth::user()->class_id;
        $semester_id = Auth::user()->semester_id;
        $getExam =  ExamScheduleModel::getExamStudent($class_id, $semester_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTime = ExamScheduleModel::getExamTimeTable($value->semester_id, $class_id);
            $resultS = array();
            foreach ($getExamTime as $valueS) {
                $dataS = array();
                $dataS['matkul_name'] = $valueS->matkul_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "My Exam";
        return view('student.my_exam', $data);
    }

    // dosen side
    public function MyExamDosen()
    {
        $result = array();
        $getClass = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['matkul_name'] = $class->matkul_name;

            $getExam = ExamScheduleModel::getExam($class->matkul_id);
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $data['exam_name'] = $exam->exam_name;
                $getExamTime = ExamScheduleModel::getExamTimeTable($exam->semester_id, $class->matkul_id);
                $resultSS = array();
                foreach ($getExamTime as $valueS) {
                    $dataS = array();
                    $dataS['matkul_name'] = $valueS->matkul_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $resultSS[] = $dataS;
                }
                $dataE['matkul'] = $resultSS;
                $examArray[] = $dataE;
            }
            $dataC['exam'] = $examArray;

            $result[] = $dataC;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "My Exam List";
        return view('dosen.my_exam_timetable', $data);
    }

    // parent side
    public function ExamMyChildren($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id = $getStudent->class_id;
        $getExam =  ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTime = ExamScheduleModel::getExamTimeTable($value->semester_id, $class_id);
            $resultS = array();
            foreach ($getExamTime as $valueS) {
                $dataS = array();
                $dataS['matkul_name'] = $valueS->matkul_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_mark'] = $valueS->full_mark;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;
            }
            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Jadwal Ujian My Children";
        return view('ortu.my_exam_children', $data);
    }
    public function ExamResultStudent()
    {
        $result = array();
        $getExam = NilaiModel::getExam(Auth::user()->id);
        foreach ($getExam as $exam) {
            $dataE = array();
            $dataE['kurikulum_name'] = $exam->kurikulum_name;
            $dataE['semester_id'] = $exam->semester_id;
            $getExamMatkul = NilaiModel::getExamMatkul($exam->semester_id, Auth::user()->id);
            $dataSubjet = array();
            foreach ($getExamMatkul as $value) {
                $total_score = ($value['tugas'] + $value['praktikum'] + $value['uts'] + $value['uas']);
                $dataS = array();
                $dataS['matkul_name'] = $value['matkul_name'];
                $dataS['matkul_type'] = $value['matkul_type'];
                $dataS['tugas'] = $value['tugas'];
                $dataS['praktikum'] = $value['praktikum'];
                $dataS['uts'] = $value['uts'];
                $dataS['uas'] = $value['uas'];
                $dataS['total_score'] = $total_score;
                $dataS['passing_mark'] = $value['passing_mark'];
                $dataS['full_mark'] = $value['full_mark'];
                $dataSubjet[] = $dataS;
            }
            $dataE['matkul'] = $dataSubjet;
            $result[]  = $dataE;
        }
        $data['getRecord'] = $result;
        $data['header_title'] = "Ujian List ";

        return view('student.my_exam_result', $data);
    }

    public function ExamResultChildren($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $result = array();
        $getExam = NilaiModel::getExam($student_id);
        foreach ($getExam as $exam) {
            $dataE = array();
            $dataE['kurikulum_name'] = $exam->kurikulum_name;
            $getExamMatkul = NilaiModel::getExamMatkul($exam->semester_id, $student_id);
            $dataSubjet = array();
            foreach ($getExamMatkul as $value) {
                $total_score = ($value['tugas'] + $value['praktikum'] + $value['uts'] + $value['uas']);
                $dataS = array();
                $dataS['matkul_name'] = $value['matkul_name'];
                $dataS['matkul_type'] = $value['matkul_type'];
                $dataS['tugas'] = $value['tugas'];
                $dataS['praktikum'] = $value['praktikum'];
                $dataS['uts'] = $value['uts'];
                $dataS['uas'] = $value['uas'];
                $dataS['total_score'] = $total_score;
                $dataS['passing_mark'] = $value['passing_mark'];
                $dataS['full_mark'] = $value['full_mark'];
                $dataSubjet[] = $dataS;
            }
            $dataE['matkul'] = $dataSubjet;
            $result[]  = $dataE;
        }
        $data['getRecord'] = $result;
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Hasil Ujian My Children ";

        return view('ortu.mychild_exam_result', $data);
    }


    public function mark_grade()
    {
        $data['getRecord'] = GradeModel::getRecord();
        $data['header_title'] = "Grade Nilai ";

        return view('admin.penilaian.mark_grade.list', $data);
    }
    public function mark_grade_add()
    {
        $data['getRecord'] = GradeModel::getRecord();
        $data['header_title'] = "Add Grade Nilai ";

        return view('admin.penilaian.mark_grade.add', $data);
    }
    public function mark_grade_insert(Request $request)
    {
        $mark = new GradeModel;
        $mark->name = trim($request->name);
        $mark->percent_to = trim($request->percent_to);
        $mark->percent_from = trim($request->percent_from);
        $mark->created_by = Auth::user()->id;
        $mark->save();
        return redirect('admin/penilaian/mark_grade')->with('success', "Grade Berhasil Ditambahkan");
    }

    public function mark_grade_edit($id)
    {
        $data['getRecord'] = GradeModel::getSingle($id);
        $data['header_title'] = "Edit Grade Nilai ";

        return view('admin.penilaian.mark_grade.edit', $data);
    }

    public function mark_grade_update($id, Request $request)
    {
        $mark = GradeModel::getSingle($id);
        $mark->name = trim($request->name);
        $mark->percent_to = trim($request->percent_to);
        $mark->percent_from = trim($request->percent_from);
        $mark->save();
        return redirect('admin/penilaian/mark_grade')->with('success', "Grade Berhasil Di Edit");
    }

    public function mark_grade_delete($id)
    {
        $mark = GradeModel::getSingle($id);
        $mark->delete();

        return redirect('admin/penilaian/mark_grade')->with('success', "Grade Berhasil Di Edit");
    }
    public function ExamResultStudentPrint(Request $request)
    {
        $semester_id = $request->semester_id;
        $student_id = $request->student_id;

        $data['getExam'] = ExamModel::getSingle($semester_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = NilaiModel::getClassStudent($semester_id, $student_id);
        $getExamMatkul = NilaiModel::getExamMatkul($semester_id, $student_id);
        $dataSubjet = array();
        foreach ($getExamMatkul as $value) {
            $total_score = ($value['tugas'] + $value['praktikum'] + $value['uts'] + $value['uas']);

            $dataS = array();
            $dataS['matkul_name'] = $value['matkul_name'];
            $dataS['matkul_type'] = $value['matkul_type'];
            $dataS['tugas'] = $value['tugas'];
            $dataS['praktikum'] = $value['praktikum'];
            $dataS['uts'] = $value['uts'];
            $dataS['uas'] = $value['uas'];
            $dataS['total_score'] = $total_score;
            $dataS['passing_mark'] = $value['passing_mark'];
            $dataS['full_mark'] = $value['full_mark'];
            $dataSubjet[] = $dataS;
        }

        $data['getNilai'] = $dataSubjet;
        // $result[]  = $dataE;
        return view('exam_result_print', $data);
    }
}
