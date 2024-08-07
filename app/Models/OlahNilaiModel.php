<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OlahNilaiModel extends Model
{
    use HasFactory;

    protected $table = 'olah_nilai';

    static public function getRecordSingle($exam_id, $class_id, $matkul_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->first();
    }



    static public function deleteRecord($semester_id, $class_id)
    {
        OlahNilaiModel::where('semester_id', '=', $semester_id)->where('class_id', '=', $class_id)->delete();
    }
    static public function getExam($class_id)
    {
        return OlahNilaiModel::select('olah_nilai.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'olah_nilai.semester_id')
            ->where('olah_nilai.class_id', '=', $class_id)
            ->groupBy('olah_nilai.semester_id')
            ->orderBy('olah_nilai.id', 'desc')
            ->get();
    }


    static public function getSubject($semester_id, $class_id)
    {
        return OlahNilaiModel::select('olah_nilai.*', 'matkul.name as matkul_name', 'matkul.type as matkul_type', 'matkul.id as matkul_id')
            ->join('matkul', 'matkul.id', '=', 'olah_nilai.matkul_id')
            ->where('olah_nilai.semester_id', '=', $semester_id)
            ->where('olah_nilai.class_id', '=', $class_id)
            ->get();
    }

    static public function getExamDosen($dosen_id)
    {
        return OlahNilaiModel::select('olah_nilai.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'olah_nilai.semester_id')
            ->join('matkul_dosen', 'matkul_dosen.class_id', '=', 'olah_nilai.class_id')
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->where('kurikulum.status', '=', 0)
            ->groupBy('olah_nilai.semester_id')
            ->orderBy('olah_nilai.id', 'desc')
            ->get();
    }
    static public function getMark($student_id, $semester_id, $class_id, $matkul_id)
    {
        return NilaiModel::CheckAlreadyMark($student_id, $semester_id, $class_id, $matkul_id);
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
}
