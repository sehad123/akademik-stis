<?php

namespace App\Models;

use Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use HasFactory;


    protected $table = 'matkul';

    static public function getRecord()
    {
        $return = SubjectModel::select('matkul.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'matkul.created_by');
        if (!empty(Request::get('name'))) {
            $return = $return->where('matkul.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('type'))) {
            $return = $return->where('matkul.type', '=',  Request::get('type'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('matkul.created_at', '=', Request::get('date'));
        }

        $return = $return->where('matkul.is_delete', '=', 0)
            ->orderBy('matkul.id', 'desc')
            ->paginate(10);

        return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSubject()
    {
        $return = SubjectModel::select('matkul.*')
            ->join('users', 'users.id', 'matkul.created_by')
            ->where('matkul.is_delete', '=', 0)
            ->where('matkul.status', '=', 0)
            ->orderBy('matkul.id', 'asc')
            ->get();

        return $return;
    }
    static public function getTotalMatkul()
    {
        $return = SubjectModel::select('matkul.*')
            ->join('users', 'users.id', 'matkul.created_by')
            ->where('matkul.is_delete', '=', 0)
            ->where('matkul.status', '=', 0)
            ->count();

        return $return;
    }
}
