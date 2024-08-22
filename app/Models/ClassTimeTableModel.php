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
        return self::where('class_timetable.class_id', '=', $class_id)  // Specify table name
            ->where('class_timetable.matkul_id', '=', $matkul_id)      // Specify table name
            ->where('class_timetable.week_id', '=', $week_id)          // Specify table name
            ->join('users', 'class_timetable.dosen_id', '=', 'users.id') // Join with users table
            ->select('class_timetable.*', 'users.name as dosen_name', 'users.id as dosen_id')   // Select dosen_name
            ->first();
    }



    static public function deleteRecord($class_id, $matkul_id)
    {
        return self::where('class_id', '=', $class_id)
            ->where('matkul_id', '=', $matkul_id)
            ->delete();
    }
}
