<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanModel extends Model
{
    use HasFactory;
    protected $table = 'perizinan';





    static public function getRecord($presensi_id)
    {
        $return = PerizinanModel::select('perizinan.*', 'matkul.name as matkul_name', 'class.name as class_name', 'users.name as name')
            ->join('users', 'users.id', '=', 'perizinan.student_id')
            ->join('presensi_mahasiswa', 'presensi_mahasiswa.id', '=', 'perizinan.presensi_id')
            ->join('class', 'class.id', '=', 'perizinan.class_id')
            ->join('matkul', 'matkul.id', '=', 'perizinan.matkul_id');

        $return = $return
            ->where('perizinan.presensi_id', '=', $presensi_id)
            ->orderBy('perizinan.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getRecordDosen($presensi_id)
    {
        $return = PerizinanModel::select('perizinan.*', 'matkul.name as matkul_name', 'class.name as class_name', 'users.name as name')
            ->join('users', 'users.id', '=', 'perizinan.dosen_id')
            ->join('presensi_mahasiswa', 'presensi_mahasiswa.id', '=', 'perizinan.presensi_id')
            ->join('class', 'class.id', '=', 'perizinan.class_id')
            ->join('matkul', 'matkul.id', '=', 'perizinan.matkul_id');

        $return = $return
            ->where('perizinan.presensi_id', '=', $presensi_id)
            ->orderBy('perizinan.id', 'desc')
            ->paginate(10);

        return $return;
    }
    static public function getRecordStudent($student_id)
    {
        $return = PerizinanModel::select('perizinan.*', 'matkul.name as matkul_name', 'class.name as class_name', 'users.name as name', 'users.last_name as last_name')
            ->join('users', 'users.id', '=', 'perizinan.student_id')
            ->join('presensi_mahasiswa', 'presensi_mahasiswa.id', '=', 'perizinan.presensi_id')
            ->join('class', 'class.id', '=', 'perizinan.class_id')
            ->join('matkul', 'matkul.id', '=', 'perizinan.matkul_id');

        $return = $return
            ->where('perizinan.student_id', '=', $student_id)
            ->orderBy('perizinan.id', 'desc')
            ->paginate(10);

        return $return;
    }
    public function getDocument()
    {
        if (!empty($this->bukti) && file_exists('upload/perizinan/' . $this->bukti)) {
            return url('upload/perizinan/' . $this->bukti);
        } else {
            return "";
        }
    }

    static public function getRecordClassMatkul($presensi_id, $class_id, $matkul_id, $student_id)
    {
        return self::where('presensi_id', '=', $presensi_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->where('student_id', '=', $student_id)->first();
    }
    static public function getRecordClassMatkulDosen($presensi_id, $class_id, $matkul_id, $dosen_id)
    {
        return self::where('presensi_id', '=', $presensi_id)->where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->where('dosen_id', '=', $dosen_id)->first();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
}
