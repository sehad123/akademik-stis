<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class presensiModel extends Model
{
    use HasFactory;
    protected $table = 'presensi_mahasiswa';

    static public function checkPresensi($student_id, $class_id, $tgl_presensi, $matkul_id, $week_id)
    {
        return presensiModel::where('student_id', '=', $student_id)->where('class_id', '=', $class_id)->where('tgl_presensi', '=', $tgl_presensi)->where('matkul_id', '=', $matkul_id)->where('week_id', '=', $week_id)->first();
    }
    static public function getRecord()
    {

        $return =  presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'class.name as class_name', 'matkul.name as matkul_name', 'student.name as student_name', 'student.last_name as student_last_name')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->join('users as student', 'student.id', '=', 'presensi_mahasiswa.student_id');

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('presensi_mahasiswa.class_id', '=', Request::get('class_id'));
        }
        if (!empty(Request::get('matkul_id'))) {
            $return = $return->where('presensi_mahasiswa.matkul_id', '=', Request::get('matkul_id'));
        }

        if (!empty(Request::get('tgl_presensi'))) {
            $return = $return->where('presensi_mahasiswa.tgl_presensi', '=', Request::get('tgl_presensi'));
        }
        if (!empty(Request::get('presensi_type'))) {
            $return = $return->where('presensi_mahasiswa.presensi_type', '=', Request::get('presensi_type'));
        }
        $return = $return->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
        return $return;
    }
    static public function getRecordDosen($class_id)
    {
        if (!empty($class_id)) {
            $return =  presensiModel::select('presensi_mahasiswa.*', 'class.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'createdby.name as created_name')
                ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
                ->join('users as student', 'student.id', '=', 'presensi_mahasiswa.student_id')
                ->join('users as createdBy', 'createdBy.id', '=', 'presensi_mahasiswa.created_by')
                ->where('presensi_mahasiswa.class_id', '=', $class_id);
            if (!empty(Request::get('class_id'))) {
                $return = $return->where('presensi_mahasiswa.class_id', '=', Request::get('class_id'));
            }

            if (!empty(Request::get('tgl_presensi'))) {
                $return = $return->where('presensi_mahasiswa.tgl_presensi', '=', Request::get('tgl_presensi'));
            }
            if (!empty(Request::get('presensi_type'))) {
                $return = $return->where('presensi_mahasiswa.presensi_type', '=', Request::get('presensi_type'));
            }

            $return = $return->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
            return $return;
        } else {
            return " ";
        }
    }
    static public function getRecordStudent($student_id)
    {

        $return =  presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->where('presensi_mahasiswa.student_id', '=', $student_id);
        if (!empty(Request::get('matkul_id'))) {
            $return = $return->where('presensi_mahasiswa.matkul_id', '=', Request::get('matkul_id'));
        }

        if (!empty(Request::get('tgl_presensi'))) {
            $return = $return->where('presensi_mahasiswa.tgl_presensi', '=', Request::get('tgl_presensi'));
        }
        if (!empty(Request::get('presensi_type'))) {
            $return = $return->where('presensi_mahasiswa.presensi_type', '=', Request::get('presensi_type'));
        }
        $return = $return->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
        return $return;
    }

    static public function getTotalPresensiStudent($student_id)
    {
        $return =  presensiModel::select('presensi_mahasiswa.id*')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->where('presensi_mahasiswa.student_id', '=', $student_id);
        $return = $return->count();
        return $return;
    }
}
