<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\ClassTimeTableModel;
use App\Models\ExamScheduleModel;
use App\Models\MatkulDosenModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Auth;

class CalendarController extends Controller
{


    public function CalendarStudentHP()
    {
        $jadwal = $this->getJadwalStudent(Auth::user()->class_id);

        $data = [
            'jadwal' => $jadwal,
        ];

        return response()->json($data);
    }


    public function CalendarStudent()
    {
        $data['getMyJadwal'] = $this->getJadwalStudent(Auth::user()->class_id);
        $data['getJadwalUjian'] = $this->jadwalUjian(Auth::user()->class_id);
        $data['header_title'] = "My Class";
        return view('student.my_calendar', $data);
    }
    public function getJadwalStudent()
    {
        $result = array();
        $getRecord = ClassMatkulModel::MySubject(Auth::user()->class_id, Auth::user()->semester_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;
            $dataS['class_name'] = $value->class_name; // Add class_name

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject = ClassTimeTableModel::getRecordClassMatkul($value->class_id, $value->matkul_id, $valueW->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['status'] = $classSubject->status;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        return $result;
    }
    public function jadwalUjian($class_id)
    {
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
        return $result;
    }


    public function ChildrenCalendar($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getMyJadwal'] = $this->getJadwalStudent($getStudent);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "My Children Calendar";
        return view('ortu.student_calendar', $data);
    }

    public function CalendarDosen()
    {
        // jadwal
        $dosen_id = Auth::user()->id;
        $data['getMyJadwal'] = MatkulDosenModel::getCalendarDosen($dosen_id);
        $data['header_title'] = "My Jadwal";
        return view('dosen.my_calendar', $data);
    }
}
