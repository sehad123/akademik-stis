<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\ExamModel;
use App\Models\ExamScheduleModel;
use App\Models\GradeModel;
use App\Models\MatkulDosenModel;
use App\Models\NilaiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ExaminationController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Ujian List ";

        return view('admin.examination.exam.list', $data);
    }
    public function exam_add()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Add Ujian List ";

        return view('admin.examination.exam.add', $data);
    }
    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);

        if (!empty($data['getRecord'])) {

            $data['header_title'] = 'Edit Exam';
            return view('admin.examination.exam.edit', $data);
        } else {
            abort(404);
        }
    }
    public function exam_insert(Request $request)
    {

        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', "Ujian Berhasil Ditambahkan");
    }

    public function exam_update($id, Request $request)
    {
        $exam = ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', "Ujian Berhasil diupdate");
    }
    public function exam_delete($id)
    {
        $user = ExamModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/examinations/exam/list')->with('success', "Ujian Berhasil dihapus");
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getMatkul = ClassMatkulModel::MySubject($request->get('class_id'));
            foreach ($getMatkul as $value) {
                $dataS = array();
                $dataS['matkul_id'] = $value->matkul_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['matkul_name'] = $value->matkul_name;
                $dataS['matkul_type'] = $value->matkul_type;
                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->matkul_id);

                if (!empty($ExamSchedule)) {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['full_mark'] = $ExamSchedule->full_mark;
                    $dataS['passing_mark'] = $ExamSchedule->passing_mark;
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['passing_mark'] = '';
                }
                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;

        $data['header_title'] = "Jadwal Ujian";

        return view('admin.examination.exam_schedule', $data);
    }

    // admin side
    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);

        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (!empty($schedule['matkul_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number']) && !empty($schedule['full_mark']) && !empty($schedule['passing_mark'])) {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->matkul_id = $schedule['matkul_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->full_mark = $schedule['full_mark'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with('success', "Jadwal Ujian Berhasil ditambahkan");
    }

    // student side
    public function ExamStudent(Request $request)
    {
        $class_id = Auth::user()->class_id;
        $getExam =  ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTime = ExamScheduleModel::getExamTimeTable($value->exam_id, $class_id);
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
                $getExamTime = ExamScheduleModel::getExamTimeTable($exam->exam_id, $class->matkul_id);
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
            $getExamTime = ExamScheduleModel::getExamTimeTable($value->exam_id, $class_id);
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
    public function mark_register(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getMatkul'] =  ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] =  User::getStudentClass($request->get('class_id'));
            // dd($data['getStudent']);
        }

        $data['header_title'] = "Mark Register";
        return view('admin.examination.mark_register', $data);
    }
    public function mark_register_dosen(Request $request)
    {
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExam'] = ExamScheduleModel::getExamDosen(Auth::user()->id);


        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getMatkul'] =  ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] =  User::getStudentClass($request->get('class_id'));
            // dd($data['getStudent']);
        }

        $data['header_title'] = "Pengelolaan Nilai";
        return view('dosen.mark_register', $data);
    }

    public function single_submit_mark(Request $request)
    {
        $id = $request->id;
        $getExam = ExamScheduleModel::getSingle($id);

        $full_mark = $getExam->full_mark;
        $tugas = !empty($request->tugas) ? $request->tugas : 0;
        $praktikum = !empty($request->praktikum) ? $request->praktikum : 0;
        $uts = !empty($request->uts) ? $request->uts : 0;
        $uas = !empty($request->uas) ? $request->uas : 0;

        $full_marks = !empty($request->full_mark) ? $request->full_mark : 0;
        $passing_mark = !empty($request->passing_mark) ? $request->passing_mark : 0;


        $total_mark = $tugas + $praktikum + $uas + $uts;
        if ($full_mark >= $total_mark) {
            $getMark = NilaiModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->matkul_id);
            if (!empty($getMark)) {
                $save = $getMark;
            } else {
                $save = new NilaiModel;
                $save->created_by = Auth::user()->id;
            }
            $save->student_id = $request->student_id;
            $save->exam_id = $request->exam_id;
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

    public function ExamResultStudent()
    {
        $result = array();
        $getExam = NilaiModel::getExam(Auth::user()->id);
        foreach ($getExam as $exam) {
            $dataE = array();
            $dataE['exam_name'] = $exam->exam_name;
            $dataE['exam_id'] = $exam->exam_id;
            $getExamMatkul = NilaiModel::getExamMatkul($exam->exam_id, Auth::user()->id);
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
            $dataE['exam_name'] = $exam->exam_name;
            $getExamMatkul = NilaiModel::getExamMatkul($exam->exam_id, $student_id);
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

        return view('admin.examination.mark_grade.list', $data);
    }
    public function mark_grade_add()
    {
        $data['getRecord'] = GradeModel::getRecord();
        $data['header_title'] = "Add Grade Nilai ";

        return view('admin.examination.mark_grade.add', $data);
    }
    public function mark_grade_insert(Request $request)
    {
        $mark = new GradeModel;
        $mark->name = trim($request->name);
        $mark->percent_to = trim($request->percent_to);
        $mark->percent_from = trim($request->percent_from);
        $mark->created_by = Auth::user()->id;
        $mark->save();
        return redirect('admin/examinations/mark_grade')->with('success', "Grade Berhasil Ditambahkan");
    }

    public function mark_grade_edit($id)
    {
        $data['getRecord'] = GradeModel::getSingle($id);
        $data['header_title'] = "Edit Grade Nilai ";

        return view('admin.examination.mark_grade.edit', $data);
    }

    public function mark_grade_update($id, Request $request)
    {
        $mark = GradeModel::getSingle($id);
        $mark->name = trim($request->name);
        $mark->percent_to = trim($request->percent_to);
        $mark->percent_from = trim($request->percent_from);
        $mark->save();
        return redirect('admin/examinations/mark_grade')->with('success', "Grade Berhasil Di Edit");
    }

    public function mark_grade_delete($id)
    {
        $mark = GradeModel::getSingle($id);
        $mark->delete();

        return redirect('admin/examinations/mark_grade')->with('success', "Grade Berhasil Di Edit");
    }
    public function ExamResultStudentPrint(Request $request)
    {
        $exam_id = $request->exam_id;
        $student_id = $request->student_id;

        $data['getExam'] = ExamModel::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);

        $data['getClass'] = NilaiModel::getClassStudent($exam_id, $student_id);
        $getExamMatkul = NilaiModel::getExamMatkul($exam_id, $student_id);
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


    // public function submit_mark(Request $request)
    // {
    //     $valiation = 0;
    //     if (!empty($request->mark)) {
    //         foreach ($request->mark as $mark) {
    //             $getExam = ExamScheduleModel::getSingle($mark['id']);
    //             $full_mark = $getExam->full_mark;


    //             $tugas = !empty($mark['tugas']) ? $mark['tugas'] : 0;
    //             $praktikum = !empty($mark['praktikum']) ? $mark['praktikum'] : 0;
    //             $uts = !empty($mark['uts']) ? $mark['uts'] : 0;
    //             $uas = !empty($mark['uas']) ? $mark['uas'] : 0;

    //             $total_mark = $tugas + $praktikum + $uas + $uts;

    //             if ($full_mark >= $total_mark) {

    //                 $getMark = NilaiModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['matkul_id']);
    //                 if (!empty($getMark)) {
    //                     $save = $getMark;
    //                 } else {
    //                     $save = new NilaiModel;
    //                     $save->created_by = Auth::user()->id;
    //                 }
    //                 $save->student_id = $request->student_id;
    //                 $save->exam_id = $request->exam_id;
    //                 $save->class_id = $request->class_id;
    //                 $save->matkul_id = $mark['matkul_id'];
    //                 $save->tugas = $tugas;
    //                 $save->praktikum = $praktikum;
    //                 $save->uts = $uts;
    //                 $save->uas = $uas;
    //                 $save->save();
    //             } else {
    //                 $valiation = 1;
    //             }
    //         }
    //     }
    //     if ($valiation == 0)
    //         $json['message'] = "Nilai berhasil disimpan";
    //     else
    //         $json['message'] = "Nilai total > nilai full";
    //     echo json_encode($json);
    // }
