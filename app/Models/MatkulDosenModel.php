<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class MatkulDosenModel extends Model
{
    use HasFactory;
    protected $table = 'matkul_dosen';

    static public function getRecord()
    {
        $return = self::select('matkul_dosen.*', 'matkul.name as matkul_name', 'class.name as class_name', 'dosen.last_name as dosen_last_name', 'dosen.name as dosen_name', 'users.name as created_by_name')
            ->join('users as dosen', 'dosen.id', 'matkul_dosen.dosen_id')
            ->join('matkul', 'matkul.id', 'matkul_dosen.matkul_id')
            ->join('class', 'class.id', 'matkul_dosen.class_id')
            ->join('users', 'users.id', 'matkul_dosen.created_by')
            ->where('matkul_dosen.is_delete', '=', 0);
        if (!empty(Request::get('dosen_name'))) {
            $return = $return->where('dosen.name', 'like', '%' . Request::get('dosen_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('matkul_dosen.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('matkul_dosen.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getMyClass($dosen_id)
    {
        return MatkulDosenModel::select('matkul_dosen.*', 'matkul.name as matkul_name', 'class.name as class_name', 'matkul.type as matkul_type', 'class.id as class_id', 'matkul.id as matkul_id')
            ->join('matkul', 'matkul.id', '=', 'matkul_dosen.matkul_id')
            ->join('matkul_class', 'matkul_class.matkul_id', '=', 'matkul.id')
            ->join('class', 'class.id', '=', 'matkul_class.class_id')
            ->where('matkul_dosen.is_delete', '=', 0)
            ->where('matkul_dosen.status', '=', 0)
            ->where('class.status', '=', 0)
            ->where('class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->get();
    }
    static public function getMyClassSubjectGroup($dosen_id)
    {
        return MatkulDosenModel::select('matkul_dosen.*', 'class.name as class_name', 'class.id as class_id')
            ->join('class', 'class.id', '=', 'matkul_dosen.class_id')
            ->where('matkul_dosen.is_delete', '=', 0)
            ->where('matkul_dosen.status', '=', 0)
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->groupBy('matkul_dosen.class_id')
            ->get();
    }
    static public function MySubject($class_id)
    {
        return self::select('matkul_class.*',  'matkul.name as matkul_name', 'matkul.type as matkul_type')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.class_id', '=', $class_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->orderBy('matkul_class.id', 'desc')
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getCalendarDosen($dosen_id)
    {
        return
            MatkulDosenModel::select('class_timetable.*', 'class.name as class_name', 'matkul.name as matkul_name', 'class.id as class_id', 'matkul.id as matkul_id', 'week.name as week_name', 'week.id as week_id', 'week.fullcalendar_day')
            ->join('class', 'class.id', '=', 'matkul_dosen.class_id')
            ->join('matkul_class', 'matkul_class.class_id', '=', 'class.id')
            ->join('class_timetable', 'class_timetable.matkul_id', '=', 'matkul_class.matkul_id')
            ->join('matkul', 'matkul.id', '=', 'class_timetable.matkul_id')
            ->join('week', 'week.id', '=', 'class_timetable.week_id')
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->where('matkul_dosen.status', '=', 0)
            ->where('matkul_dosen.is_delete', '=', 0)
            ->get();
    }

    static public function getAssignDosenID($matkul_id)
    {
        return self::where('matkul_id', '=', $matkul_id)->where('is_delete', '=', 0)->get();
    }
    static public function deleteSubject($dosen_id)
    {
        return self::where('dosen_id', '=', $dosen_id)->delete();
    }

    static public function getFirstAlready($matkul_id, $dosen_id)
    {
        return
            self::where('matkul_id', '=', $matkul_id)
            ->where('dosen_id', '=', $dosen_id)->first();
    }
    static public function getTimeTable($class_id, $matkul_id)
    {
        $getWeek = WeekModel::getWeekByName(date('l'));
        return ClassTimeTableModel::getRecordClassMatkul($class_id, $matkul_id, $getWeek->id);
        // return date('');
    }
}
