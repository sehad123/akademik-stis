<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class PengumumanModel extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';

    static public function getRecord()
    {
        $return =  self::select('pengumuman.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'pengumuman.created_by');

        if (!empty(Request::get('judul'))) {
            $return = $return->where('pengumuman.judul', 'like', '%' . Request::get('judul') . '%');
        }
        if (!empty(Request::get('pengumuman_from'))) {
            $return = $return->whereDate('pengumuman.tgl_pengumuman', '>=', Request::get('pengumuman_from'));
        }

        if (!empty(Request::get('pengumuman_to'))) {
            $return = $return->whereDate('pengumuman.tgl_pengumuman', '<=', Request::get('pengumuman_to'));
        }
        if (!empty(Request::get('publish_from'))) {
            $return = $return->whereDate('pengumuman.tgl_publish', '>=', Request::get('publish_from'));
        }

        if (!empty(Request::get('publish_to'))) {
            $return = $return->whereDate('pengumuman.tgl_publish', '<=', Request::get('publish_to'));
        }
        // if (!empty(Request::get('pesan_to'))) {
        //     $return = $return->join('pesan_pengumuman', 'pesan_pengumuman.pengumuman_id', '=', 'pengumuman.id');
        // $return = $return->where('pesan_pengumuman.pesan_to', '<=', Request::get('pesan_to'));
        // }

        $return = $return->orderBy('pengumuman.id', 'desc')
            ->paginate(20);
        return $return;
    }
    public function getPesan()
    {
        return $this->hasMany(PesanPengumumanModel::class, "pengumuman_id");
    }
    public function getPesanToSingle($pengumuman_id, $pesan_to)
    {
        PesanPengumumanModel::where('pengumuman_id', '=', $pengumuman_id)->where('pesan_to', '=', $pesan_to)->first();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecordUser($pesan_to)
    {
        $return =  PengumumanModel::select('pengumuman.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'pengumuman.created_by');
        $return = $return->join('pesan_pengumuman', 'pesan_pengumuman.pengumuman_id', '=', 'pengumuman.id');

        if (!empty(Request::get('judul'))) {
            $return = $return->where('pengumuman.judul', 'like', '%' . Request::get('judul') . '%');
        }
        if (!empty(Request::get('pengumuman_from'))) {
            $return = $return->whereDate('pengumuman.tgl_pengumuman', '>=', Request::get('pengumuman_from'));
        }

        if (!empty(Request::get('pengumuman_to'))) {
            $return = $return->whereDate('pengumuman.tgl_pengumuman', '<=', Request::get('pengumuman_to'));
        }
        $return = $return->where('pesan_pengumuman.pesan_to', '=', $pesan_to);
        // $return = $return->where('pengumuman.tgl_publish', '>=', date('Y-m-d'));
        $return = $return->orderBy('pengumuman.id', 'desc')->paginate(5);
        return $return;
    }
}
