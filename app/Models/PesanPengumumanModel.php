<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanPengumumanModel extends Model
{
    use HasFactory;
    protected $table = 'pesan_pengumuman';

    static public function DeleteRecord($id)
    {
        PesanPengumumanModel::where('pengumuman_id', '=', $id)->delete();
    }
}
