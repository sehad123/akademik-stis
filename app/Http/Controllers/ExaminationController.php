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
        $exam->status = 1;
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', "Ujian Berhasil Ditambahkan");
    }

    public function exam_update($id, Request $request)
    {
        $exam = ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->status = 1;
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
                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
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
                if (!empty($schedule['matkul_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time']) && !empty($schedule['room_number'])) {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->matkul_id = $schedule['matkul_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
        }
        return redirect()->back()->with('success', "Jadwal Ujian Berhasil ditambahkan");
    }

    // student side
    public function ExamStudent()
    {
        $class_id = Auth::user()->class_id;
        $getExam =  ExamScheduleModel::getExamStudent($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->kurikulum_name;
            $getExamTime = ExamScheduleModel::getExamTimeTable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTime as $valueS) {
                $dataS = array();
                $dataS['matkul_name'] = $valueS->matkul_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
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
}
