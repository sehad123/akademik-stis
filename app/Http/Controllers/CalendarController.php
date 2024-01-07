<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\ClassTimeTableModel;
use App\Models\SubjectModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Auth;

class CalendarController extends Controller
{
    public function CalendarStudent()
    {
        $result = array();
        $getRecord = ClassMatkulModel::MySubject(Auth::user()->class_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($value->class_id, $value->matkul_id, $valueW->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyJadwal'] = $result;
        // $data['getRecord'] = $result;
        $data['header_title'] = "My Class";
        return view('student.my_calendar', $data);
    }
}
