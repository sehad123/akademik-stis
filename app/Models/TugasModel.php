<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Auth;

class TugasModel extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    static public function getRecordTugas()
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id');
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        if (!empty(Request::get('deadline_from'))) {
            $return = $return->whereDate('tugas.deadline', '>=', Request::get('deadline_from'));
        }
        if (!empty(Request::get('deadline_to'))) {
            $return = $return->whereDate('tugas.deadline', '<=', Request::get('deadline_to'));
        }
        $return = $return->where('tugas.is_delete', '=', 0)
            ->where('tugas.status', '=', 0)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getRecordMateri()
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id');
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        if (!empty(Request::get('deadline_from'))) {
            $return = $return->whereDate('tugas.deadline', '>=', Request::get('deadline_from'));
        }
        if (!empty(Request::get('deadline_to'))) {
            $return = $return->whereDate('tugas.deadline', '<=', Request::get('deadline_to'));
        }
        $return = $return->where('tugas.is_delete', '=', 0)
            ->where('tugas.status', '=', 1)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getRecordPenugasanDosen($class_id)
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id')
            // ->where('tugas.class_id', '=', $class_id)
            ->where('tugas.created_by', '=', Auth::user()->id)
            ->where('tugas.status', '=', 0);
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        if (!empty(Request::get('deadline_from'))) {
            $return = $return->whereDate('tugas.deadline', '>=', Request::get('deadline_from'));
        }
        if (!empty(Request::get('deadline_to'))) {
            $return = $return->whereDate('tugas.deadline', '<=', Request::get('deadline_to'));
        }
        $return = $return->where('tugas.is_delete', '=', 0)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getRecordMateriDosen($class_id)
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id')
            // ->where('tugas.class_id', '=', $class_id)
            ->where('tugas.created_by', '=', Auth::user()->id)
            ->where('tugas.status', '=', 1);
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        $return = $return->where('tugas.is_delete', '=', 0)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }


    static public function getRecordTugasStudent($class_id, $student_id)
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id')
            ->where('tugas.class_id', '=', $class_id)
            ->where('tugas.status', '=', 0)
            ->whereNotIn('tugas.id', function ($query) use ($student_id) {
                $query->select('submit_tugas.tugas_id')->from('submit_tugas')->where('submit_tugas.student_id', '=', $student_id);
            });
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        if (!empty(Request::get('deadline_from'))) {
            $return = $return->whereDate('tugas.deadline', '>=', Request::get('deadline_from'));
        }
        if (!empty(Request::get('deadline_to'))) {
            $return = $return->whereDate('tugas.deadline', '<=', Request::get('deadline_to'));
        }
        $return = $return->where('tugas.is_delete', '=', 0)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getRecordMateriStudent($class_id, $student_id)
    {
        $return = TugasModel::select('tugas.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id')
            ->where('tugas.class_id', '=', $class_id)
            ->where('tugas.status', '=', 1)
            ->whereNotIn('tugas.id', function ($query) use ($student_id) {
                $query->select('submit_tugas.tugas_id')->from('submit_tugas')->where('submit_tugas.student_id', '=', $student_id);
            });
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }

        $return = $return->where('tugas.is_delete', '=', 0)
            ->orderBy('tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getTotalTugasStudent($class_id, $student_id)
    {
        $return = TugasModel::select('tugas.id*')
            ->join('users', 'users.id', '=', 'tugas.created_by')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id')
            ->where('tugas.class_id', '=', $class_id)
            ->whereNotIn('tugas.id', function ($query) use ($student_id) {
                $query->select('submit_tugas.tugas_id')->from('submit_tugas')->where('submit_tugas.student_id', '=', $student_id);
            });
        $return = $return->where('tugas.is_delete', '=', 0)
            ->count();

        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }


    public function getDocument()
    {
        if (!empty($this->document) && file_exists('upload/tugas/' . $this->document)) {
            return url('upload/tugas/' . $this->document);
        } else {
            return "";
        }
    }
}
