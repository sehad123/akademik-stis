<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Request;

class ClassMatkulModel extends Model
{
    use HasFactory;

    protected $table = 'matkul_class';

    static public function getRecord()
    {
        $return = self::select('matkul_class.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_by_name', 'kurikulum.name as semester_name', 'kurikulum.id as semester_id')
            ->join('kurikulum', 'kurikulum.id', 'matkul_class.semester_id')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.is_delete', '=', 0);

        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('semester_name'))) {
            $return = $return->where('kurikulum.name', 'like', '%' . Request::get('semester_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }

        $return = $return->orderBy('matkul_class.id', 'desc')->paginate(20);

        return $return;
    }

    static public function MySubjectMatkul($class_id)
    {
        return self::select('matkul_class.*', 'matkul.name as matkul_name', 'matkul_id as matkul_id', 'matkul.type as matkul_type', 'class.name as class_name', 'kurikulum.name as semester_name')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('kurikulum', 'kurikulum.id', 'matkul_class.semester_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.class_id', '=', $class_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->orderBy('matkul_class.id', 'desc')
            ->get();
    }

    static public function MySubject($class_id, $semester_id)
    {
        return self::select('matkul_class.*', 'matkul.name as matkul_name', 'matkul_id as matkul_id', 'matkul.type as matkul_type', 'class.name as class_name', 'kurikulum.name as semester_name')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('kurikulum', 'kurikulum.id', 'matkul_class.semester_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.class_id', '=', $class_id)
            ->where('matkul_class.semester_id', '=', $semester_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->orderBy('matkul_class.id', 'desc')
            ->get();
    }



    static public function MySubjectDosen($matkul_id)
    {
        return self::select('matkul_class.*', 'matkul.name as matkul_name', 'matkul.type as matkul_type', 'class.name as class_name')
            ->join('matkul', 'matkul.id', '=', 'matkul_class.matkul_id')
            ->join('class', 'class.id', '=', 'matkul_class.class_id')
            ->join('users', 'users.id', '=', 'matkul_class.created_by')
            ->where('matkul_class.matkul_id', '=', $matkul_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->orderBy('matkul_class.id', 'desc')
            ->get();
    }



    static public function getTotalMatkulStudent($class_id)
    {
        return self::select('matkul_class.id*')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.class_id', '=', $class_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->count();
    }
    static public function MySubjectStudent($class_id)
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

    static public function getAssignSubjectID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }
    static public function deleteSubject($class_id, $semester_id)
    {
        return self::where('class_id', '=', $class_id)->where('semester_id', '=', $semester_id)->delete();
    }

    static public function getFirstAlready($class_id, $matkul_id, $semester_id)
    {
        return
            self::where('class_id', '=', $class_id)
            ->where('matkul_id', '=', $matkul_id)
            ->where('semester_id', '=', $semester_id)
            ->first();
    }


    static public function SubjectSemester($semester_id, $class_id)
    {
        $return = self::select('matkul_class.*', 'class.name as class_name', 'matkul.name as matkul_name', 'matkul.type as matkul_type', 'users.name as created_by_name', 'kurikulum.name as semester_name', 'kurikulum.id as semester_id', 'class.id as class_id')
            ->join('kurikulum', 'kurikulum.id', 'matkul_class.semester_id')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.semester_id', '=', $semester_id)
            ->where('matkul_class.class_id', '=', $class_id)
            ->where('matkul_class.is_delete', '=', 0)
            ->where('matkul_class.status', '=', 0)
            ->orderBy('matkul_class.id', 'desc')
            ->get();
        return $return;
    }
}
