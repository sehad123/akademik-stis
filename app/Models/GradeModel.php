<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class GradeModel extends Model
{
    use HasFactory;
    protected $table = 'grade_nilai';

    static public function getRecord()
    {
        $return = self::select('grade_nilai.*', 'users.name as created_name')
            ->join('users', 'users.id', '=', 'grade_nilai.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('grade_nilai.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('perecent_to'))) {
            $return = $return->where('grade_nilai.perecent_to', 'like', '%' . Request::get('perecent_to') . '%');
        }
        if (!empty(Request::get('percent_from'))) {
            $return = $return->where('grade_nilai.percent_from', 'like', '%' . Request::get('percent_from') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('grade_nilai.created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('grade_nilai.id', 'desc')
            ->paginate(50);
        return $return;
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getGrade($percent)
    {
        $return = GradeModel::select('grade_nilai.*')
            ->where('percent_from', '<=', $percent)
            ->where('percent_to', '>=', $percent)
            ->first();
        return !empty($return->name) ? $return->name : '';
    }
}
