<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTimeTableModel extends Model
{
    use HasFactory;

    protected $table = 'class_timetable';

    static public function getRecordClassMatkul($class_id, $matkul_id, $week_id)
    {
        return self::where('class_id', '=', $class_id)->where('matkul_id', '=', $matkul_id)->where('week_id', '=', $week_id)->first();
    }
}
