<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Request;

class ClassMatkulModel extends Model
{
    use HasFactory;

    protected $table = 'matkul_class';

    static public function getRecord()
    {
        $return = self::select('matkul_class.*', 'class.name as class_name', 'matkul.name as matkul_name', 'users.name as created_by_name')
            ->join('matkul', 'matkul.id', 'matkul_class.matkul_id')
            ->join('class', 'class.id', 'matkul_class.class_id')
            ->join('users', 'users.id', 'matkul_class.created_by')
            ->where('matkul_class.is_delete', '=', 0);
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('matkul_name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('matkul_name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('matkul_class.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('matkul_class.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getAssignSubjectID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }
    static public function deleteSubject($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    static public function getFirstAlready($class_id, $matkul_id)
    {
        return
            self::where('class_id', '=', $class_id)
            ->where('matkul_id', '=', $matkul_id)->first();
    }
}
