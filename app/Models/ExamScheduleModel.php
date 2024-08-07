<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ujian';

    static public function getRecordSingle($exam_id, $class_id, $matkul_id)
    {
        return self::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->first();
    }



    static public function deleteRecord($exam_id, $class_id)
    {
        ExamScheduleModel::where('exam_id', '=', $exam_id)->where('class_id', '=', $class_id)->delete();
    }
    static public function getExam($class_id)
    {
        return ExamScheduleModel::select('jadwal_ujian.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'jadwal_ujian.exam_id')
            ->where('jadwal_ujian.class_id', '=', $class_id)
            ->groupBy('jadwal_ujian.exam_id')
            ->orderBy('jadwal_ujian.id', 'desc')
            ->get();
    }
    static public function getExamStudent($class_id, $semester_id)
    {
        return ExamScheduleModel::select('jadwal_ujian.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'jadwal_ujian.exam_id')
            ->where('jadwal_ujian.class_id', '=', $class_id)
            ->where('jadwal_ujian.semester_id', '=', $semester_id)
            ->where('kurikulum.status', '=', 1)
            ->groupBy('jadwal_ujian.exam_id')
            ->orderBy('jadwal_ujian.id', 'desc')
            ->get();
    }
    static public function getExamDosen($dosen_id)
    {
        return ExamScheduleModel::select('jadwal_ujian.*', 'kurikulum.name as kurikulum_name')
            ->join('kurikulum', 'kurikulum.id', '=', 'jadwal_ujian.exam_id')
            ->join('matkul_dosen', 'matkul_dosen.class_id', '=', 'jadwal_ujian.class_id')
            ->where('matkul_dosen.dosen_id', '=', $dosen_id)
            ->groupBy('jadwal_ujian.exam_id')
            ->orderBy('jadwal_ujian.id', 'desc')
            ->get();
    }

    static public function getExamTimeTable($exam_id, $class_id)
    {
        return ExamScheduleModel::select('jadwal_ujian.*', 'matkul.name as matkul_name', 'matkul.type as matkul_type')
            ->join('matkul', 'matkul.id', '=', 'jadwal_ujian.matkul_id')
            ->where('jadwal_ujian.exam_id', '=', $exam_id)
            ->where('jadwal_ujian.class_id', '=', $class_id)
            ->get();
    }
    static public function getSubject($exam_id, $class_id)
    {
        return ExamScheduleModel::select('jadwal_ujian.*', 'matkul.name as matkul_name', 'matkul.type as matkul_type', 'matkul.id as matkul_id')
            ->join('matkul', 'matkul.id', '=', 'jadwal_ujian.matkul_id')
            ->where('jadwal_ujian.exam_id', '=', $exam_id)
            ->where('jadwal_ujian.class_id', '=', $class_id)
            ->get();
    }
    static public function getMark($student_id, $exam_id, $class_id, $matkul_id)
    {
        return NilaiModel::CheckAlreadyMark($student_id, $exam_id, $class_id, $matkul_id);
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
}
