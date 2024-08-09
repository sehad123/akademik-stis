<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Carbon\Carbon;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'kurikulum';

    // static public function getSemester()
    // {
    //     $return = self::select('kurikulum.*')
    //         ->join('users', 'users.id', '=', 'kurikulum.created_by')
    //         ->where('kurikulum.is_delete', '=', 0)
    //         ->where('kurikulum.status', '=', 0)
    //         ->orderBy('kurikulum.id', 'desc')
    //         ->get();
    //     return $return;
    // }

    static public function getSemester()
    {
        // Mendapatkan bulan saat ini
        $currentMonth = Carbon::now()->month;

        $return = self::select('kurikulum.*')
            ->join('users', 'users.id', '=', 'kurikulum.created_by')
            ->where('kurikulum.is_delete', '=', 0)
            ->where('kurikulum.status', '=', 0);

        // Logika untuk menampilkan record berdasarkan bulan saat ini
        if ($currentMonth >= 2 && $currentMonth <= 7) { // Februari - Juli
            $return = $return->whereRaw('MOD(kurikulum.id, 2) != 0'); // ID ganjil
        } else { // Agustus - Januari
            $return = $return->whereRaw('MOD(kurikulum.id, 2) = 0'); // ID genap
        }

        $return = $return->orderBy('kurikulum.id', 'desc')->get();

        return $return;
    }


    static public function getExam()
    {
        $return = self::select('kurikulum.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'kurikulum.created_by')
            ->where('kurikulum.is_delete', '=', 0)
            ->where('kurikulum.status', '=', 1)
            ->orderBy('kurikulum.id', 'desc')
            ->get();
        return $return;
    }
    static public function getRecord()
    {
        $return = self::select('kurikulum.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'kurikulum.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('kurikulum.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('kurikulum.created_at', '=', Request::get('date'));
        }
        $return = $return->where('kurikulum.is_delete', '=', 0)
            ->orderBy('kurikulum.id', 'desc')
            ->where('kurikulum.status', '=', 1)
            ->paginate(50);
        return $return;
    }
    static public function getRecordNilai()
    {
        $return = self::select('kurikulum.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'kurikulum.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('kurikulum.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('kurikulum.created_at', '=', Request::get('date'));
        }
        $return = $return->where('kurikulum.is_delete', '=', 0)
            ->orderBy('kurikulum.id', 'desc')
            ->where('kurikulum.status', '=', 0)
            ->paginate(50);
        return $return;
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getkurikulum()
    {
        $return = self::select('kurikulum.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'kurikulum.created_by')
            ->where('kurikulum.is_delete', '=', 0)
            ->where('kurikulum.status', '=', 1)
            ->orderBy('kurikulum.id', 'desc')
            ->get();
        return $return;
    }

    static public function getTotalUjian()
    {
        $return = self::select('kurikulum.*')
            ->join('users', 'users.id', '=', 'kurikulum.created_by')
            ->where('kurikulum.status', '=', 1)
            ->where('kurikulum.is_delete', '=', 0)
            ->count();
        return $return;
    }
}
