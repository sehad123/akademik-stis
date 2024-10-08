<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiModel extends Model
{
    use HasFactory;
    protected $table = 'nilai';

    static public function CheckAlreadyMark($student_id, $semester_id, $class_id, $matkul_id)
    {
        return NilaiModel::where('student_id', '=', $student_id)->where('semester_id', '=', $semester_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->first();
    }
    static public function getExam($student_id)
    {
        return NilaiModel::select('nilai.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'nilai.semester_id')
            ->where('nilai.student_id', '=', $student_id)
            ->groupBy('nilai.semester_id')
            ->get();
    }
    static public function getExamMatkul($semester_id, $student_id)
    {
        return NilaiModel::select('nilai.*', 'kurikulum.name as kurikulum_name', 'matkul.name as matkul_name', 'matkul.type as matkul_type')
            ->join('kurikulum', 'kurikulum.id', '=', 'nilai.semester_id')
            ->join('matkul', 'matkul.id', '=', 'nilai.matkul_id')
            ->where('nilai.semester_id', '=', $semester_id)
            ->where('nilai.student_id', '=', $student_id)
            ->get();
    }

    static public function getClassStudent($semester_id, $student_id)
    {
        return NilaiModel::select('class.name as class_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'nilai.semester_id')
            ->join('matkul', 'matkul.id', '=', 'nilai.matkul_id')
            ->join('class', 'class.id', '=', 'nilai.class_id')
            ->where('nilai.semester_id', '=', $semester_id)
            ->where('nilai.student_id', '=', $student_id)
            ->first();
    }
}
