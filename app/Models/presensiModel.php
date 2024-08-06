<?php

namespace App\Models;

use Log;
use Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class presensiModel extends Model
{
    use HasFactory;
    protected $table = 'presensi_mahasiswa';

    protected $fillable = [
        'student_id',
        'dosen_id',
        'class_id',
        'matkul_id',
        'week_id',
        'presensi_type',
        'tgl_presensi',
        'face_image',
        'latitude',  // Menambahkan latitude
        'longitude',  // Menambahkan longitude
        'bobot'  // Menambahkan bobot
    ];

    // Metode yang lain tetap sama
    public static function checkPresensi($student_id, $class_id, $tgl_presensi, $matkul_id, $week_id)
    {
        return self::where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->where('tgl_presensi', $tgl_presensi)
            ->where('matkul_id', $matkul_id)
            ->where('week_id', $week_id)
            ->first();
    }

    static public function checkPresensiDosen($dosen_id, $class_id, $tgl_presensi, $matkul_id, $week_id)
    {
        return self::where('dosen_id', $dosen_id)
            ->where('class_id', $class_id)
            ->where('tgl_presensi', $tgl_presensi)
            ->where('matkul_id', $matkul_id)
            ->where('week_id', $week_id)
            ->first();
    }


    static public function getRecord()
    {
        $return = presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'class.name as class_name', 'student.name as student_name', 'student.id as student_id', 'matkul.id as matkul_id', 'class.id as class_id')
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

        if (!empty(Request::get('student_name'))) {
            $return = $return->where('student.name', 'like', '%' . Request::get('student_name') . '%');
        }

        $return = $return->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
        return $return;
    }

    static public function getRecordDosenn()
    {
        $return =  presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'class.name as class_name', 'matkul.name as matkul_name',  'dosen.name as dosen_name',  'dosen.id as dosen_id', 'matkul.id as matkul_id', 'class.id as class_id')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->join('users as dosen', 'dosen.id', '=', 'presensi_mahasiswa.dosen_id');

        if (!empty(Request::get('class_id'))) {
            $return = $return->where('presensi_mahasiswa.class_id', '=', Request::get('class_id'));
        }
        if (!empty(Request::get('matkul_id'))) {
            $return = $return->where('presensi_mahasiswa.matkul_id', '=', Request::get('matkul_id'));
        }

        if (!empty(Request::get('tgl_presensi'))) {
            $return = $return->where('presensi_mahasiswa.tgl_presensi', '=', Request::get('tgl_presensi'));
        }
        if (!empty(Request::get('dosen_name'))) {
            $return = $return->where('dosen.name', 'like', '%' . Request::get('dosen_name') . '%');
        }
        $return = $return->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
        return $return;
    }

    static public function getRecordDosennn($class_id, $matkul_id, $dosen_id)
    {
        $query = presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'class.name as class_name', 'users.name as dosen_name')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->join('users', 'users.id', '=', 'presensi_mahasiswa.dosen_id')
            ->where('presensi_mahasiswa.class_id', '=', $class_id)
            ->where('presensi_mahasiswa.matkul_id', '=', $matkul_id)
            ->where('presensi_mahasiswa.dosen_id', '=', $dosen_id);

        // Debug log

        return $query->orderBy('presensi_mahasiswa.id', 'desc')->paginate(20);
    }



    static public function getRecordDosen($class_id)
    {
        if (!empty($class_id)) {
            $return =  presensiModel::select('presensi_mahasiswa.*', 'class.name as class_name', 'dosen.name as dosen_name', 'createdby.name as created_name')
                ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
                ->join('users as dosen', 'dosen.id', '=', 'presensi_mahasiswa.dosen_id')
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
        $return =  presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'matkul.id as matkul_id', 'class.id as class_id')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->where('presensi_mahasiswa.student_id', '=', $student_id);
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
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

    static public function getRecorddDosen($dosen_id)
    {
        $return =  presensiModel::select('presensi_mahasiswa.*', 'matkul.name as matkul_name', 'matkul.id as matkul_id', 'class.id as class_id')
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->where('presensi_mahasiswa.dosen_id', '=', $dosen_id);
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
    public function getProfilePresensi()
    {
        $path = 'face_recognition_api/upload/presensi/' . $this->face_image;
        if (!empty($this->face_image) && file_exists($path)) {
            return url($path);
        } else {
            // Log the path or an error message
            return url('face_recognition_api/upload/profile/user.png');
        }
    }

    public static function getPresensi($dosen_id, $class_id, $tgl_presensi, $matkul_id)
    {
        return presensiModel::where('dosen_id', '=', $dosen_id)
            ->where('class_id', '=', $class_id)
            ->where('tgl_presensi', '=', $tgl_presensi)
            ->where('matkul_id', '=', $matkul_id)
            ->first();
    }

    public static function getPresensiDataForExport($filter)
    {
        $query = self::select(
            'presensi_mahasiswa.id',
            'student.name as student_name',
            'class.name as class_name',
            'matkul.name as matkul_name',
            'presensi_mahasiswa.presensi_type',
            'presensi_mahasiswa.tgl_presensi',
            'presensi_mahasiswa.bobot'
        )
            ->join('matkul', 'matkul.id', '=', 'presensi_mahasiswa.matkul_id')
            ->join('class', 'class.id', '=', 'presensi_mahasiswa.class_id')
            ->join('users as student', 'student.id', '=', 'presensi_mahasiswa.student_id');

        if (!empty($filter['class_id'])) {
            $query = $query->where('presensi_mahasiswa.class_id', '=', $filter['class_id']);
        }
        if (!empty($filter['matkul_id'])) {
            $query = $query->where('presensi_mahasiswa.matkul_id', '=', $filter['matkul_id']);
        }
        if (!empty($filter['tgl_presensi'])) {
            $query = $query->where('presensi_mahasiswa.tgl_presensi', '=', $filter['tgl_presensi']);
        }
        if (!empty($filter['presensi_type'])) {
            $query = $query->where('presensi_mahasiswa.presensi_type', '=', $filter['presensi_type']);
        }

        return $query->get();
    }
}
