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
        return ExamScheduleModel::select('jadwal_ujian.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'jadwal_ujian.exam_id')
            ->where('jadwal_ujian.class_id', '=', $class_id)
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
            ->groupBy('exam_id')
            ->get();
    }
}
