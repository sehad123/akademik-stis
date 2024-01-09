<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiModel extends Model
{
    use HasFactory;
    protected $table = 'nilai';

    static public function CheckAlreadyMark($student_id, $exam_id, $class_id, $matkul_id)
    {
        return NilaiModel::where('student_id', '=', $student_id)->where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->first();
    }
    static public function getExam($student_id)
    {
        return NilaiModel::select('nilai.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'nilai.exam_id')
            ->where('nilai.student_id', '=', $student_id)
            ->groupBy('nilai.exam_id')
            ->get();
    }
    static public function getExamMatkul($exam_id, $student_id)
    {
        return NilaiModel::select('nilai.*', 'exam.name as exam_name', 'matkul.name as matkul_name', 'matkul.type as matkul_type')
            ->join('exam', 'exam.id', '=', 'nilai.exam_id')
            ->join('matkul', 'matkul.id', '=', 'nilai.matkul_id')
            ->where('nilai.exam_id', '=', $exam_id)
            ->where('nilai.student_id', '=', $student_id)
            ->get();
    }
}
