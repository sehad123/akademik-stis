<?php

namespace App\Models;

use Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemesterClassModel extends Model
{
    use HasFactory;
    protected $table = 'semester_class';


    static public function getRecord()
    {
        $return = self::select('semester_class.*', 'class.name as class_name', 'kurikulum.name as semester_name', 'users.name as created_by_name')
            ->join('kurikulum', 'kurikulum.id', 'semester_class.semester_id')
            ->join('class', 'class.id', 'semester_class.class_id')
            ->join('users', 'users.id', 'semester_class.created_by')
            ->where('semester_class.is_delete', '=', 0);
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('semester_name'))) {
            $return = $return->where('kurikulum.name', 'like', '%' . Request::get('semester_name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('semester_class.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('semester_class.id', 'desc')
            ->paginate(20);

        return $return;
    }
    static public function MySubjectSemester($semester_id)
    {
        try {
            $result = self::select('semester_class.*', 'kurikulum.name as semester_name', 'kurikulum.id as semester_id', 'class.name as class_name', 'class.id as class_id')
                ->join('class', 'class.id', 'semester_class.class_id')
                ->join('kurikulum', 'kurikulum.id', 'semester_class.semester_id')
                ->join('users', 'users.id', 'semester_class.created_by')
                ->where('semester_class.semester_id', '=', $semester_id)
                ->where('semester_class.is_delete', '=', 0)
                ->where('semester_class.status', '=', 0)
                ->orderBy('semester_class.id', 'desc')
                ->get();
            Log::info('Query Result: ', $result->toArray());
            return $result;
        } catch (\Exception $e) {
            Log::error('Error in MySubject: ' . $e->getMessage());
            return null;
        }
    }
    static public function MySubjectDosen($semester_id)
    {
        return self::select('semester_class.*', 'semester.name as semester_name', 'semester.type as semester_type', 'class.name as class_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'semester_class.semester_id')
            ->join('class', 'class.id', '=', 'semester_class.class_id')
            ->join('users', 'users.id', '=', 'semester_class.created_by')
            ->where('semester_class.semester_id', '=', $semester_id)
            ->where('semester_class.is_delete', '=', 0)
            ->where('semester_class.status', '=', 0)
            ->orderBy('semester_class.id', 'desc')
            ->get();
    }



    static public function getTotalsemesterStudent($class_id)
    {
        return self::select('semester_class.id*')
            ->join('kurikulum', 'kurikulum.id', 'semester_class.semester_id')
            ->join('class', 'class.id', 'semester_class.class_id')
            ->join('users', 'users.id', 'semester_class.created_by')
            ->where('semester_class.class_id', '=', $class_id)
            ->where('semester_class.is_delete', '=', 0)
            ->where('semester_class.status', '=', 0)
            ->count();
    }
    static public function MySubjectStudent($class_id)
    {
        return self::select('semester_class.*',  'semester.name as semester_name', 'semester.type as semester_type')
            ->join('kurikulum', 'kurikulum.id', 'semester_class.semester_id')
            ->join('class', 'class.id', 'semester_class.class_id')
            ->join('users', 'users.id', 'semester_class.created_by')
            ->where('semester_class.class_id', '=', $class_id)
            ->where('semester_class.is_delete', '=', 0)
            ->where('semester_class.status', '=', 0)
            ->orderBy('semester_class.id', 'desc')
            ->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getAssignSubjectID($class_id)
    {
        return self::where('semester_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }
    static public function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    static public function getFirstAlready($class_id, $semester_id)
    {
        return
            self::where('class_id', '=', $class_id)
            ->where('semester_id', '=', $semester_id)->first();
    }
}
