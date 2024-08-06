<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubmitTugasModel extends Model
{
    use HasFactory;
    protected $table = 'submit_tugas';


    static public function getRecord($tugas_id)
    {
        $return = SubmitTugasModel::select('submit_tugas.*', 'users.name as first_name')
            ->join('users', 'users.id', '=', 'submit_tugas.student_id');
        if (!empty(Request::get('first_name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('first_name') . '%');
        }
        if (!empty(Request::get('deadline_from'))) {
            $return = $return->whereDate('submit_tugas.created_at', '>=', Request::get('deadline_from'));
        }
        if (!empty(Request::get('deadline_to'))) {
            $return = $return->whereDate('submit_tugas.created_at', '<=', Request::get('deadline_to'));
        }
        $return = $return->where('submit_tugas.tugas_id', '=', $tugas_id)
            ->orderBy('submit_tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getRecordStudent($student_id)
    {
        $return = SubmitTugasModel::select('submit_tugas.*', 'matkul.name as matkul_name', 'class.name as class_name')
            ->join('tugas', 'tugas.id', '=', 'submit_tugas.tugas_id')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id');
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        $return = $return->where('submit_tugas.student_id', '=', $student_id)
            ->orderBy('submit_tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getTotalSubmittedStudent($student_id)
    {
        $return = SubmitTugasModel::select('submit_tugas.id*')
            ->join('tugas', 'tugas.id', '=', 'submit_tugas.tugas_id')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id');
        $return = $return->where('submit_tugas.student_id', '=', $student_id)
            ->count();
        return $return;
    }

    static public function getRecordTugas()
    {
        $return = SubmitTugasModel::select('submit_tugas.*', 'matkul.name as matkul_name', 'class.name as class_name', 'users.name as first_name', 'tugas.tanggal as tanggal')
            ->join('users', 'users.id', '=', 'submit_tugas.student_id')
            ->join('tugas', 'tugas.id', '=', 'submit_tugas.tugas_id')
            ->join('class', 'class.id', '=', 'tugas.class_id')
            ->join('matkul', 'matkul.id', '=', 'tugas.matkul_id');
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }
        $return = $return->orderBy('submit_tugas.id', 'desc')
            ->paginate(10);

        return $return;
    }
    public function getDocument()
    {
        if (!empty($this->document) && file_exists('upload/tugas/' . $this->document)) {
            return url('upload/tugas/' . $this->document);
        } else {
            return "";
        }
    }

    public function getTugas()
    {
        return $this->belongsTo(TugasModel::class, 'tugas_id');
    }
    public function getStudent()
    {
        return $this->belongsTo(TugasModel::class, 'student_id');
    }
}
