<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;
use Cache;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic', // Tambahkan kolom ini

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // method update dan delete
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function OnlineUser()
    {
        return Cache::has('OnlineUser' . $this->id);
    }




    static public function getTotalUser($user_type)
    {
        return self::select('users.id')->where('user_type', '=', $user_type)->where('is_delete', '=', 0)->count();
    }



    // method forget password
    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }
    // method get all
    static public function getAdmin()
    {
        $return =  self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return =  $return->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
    }

    static public function getParent()
    {
        $return =  self::select('users.*')
            ->where('user_type', '=', 4)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }

        if (!empty(Request::get('occupation'))) {
            $return = $return->where('occupation', 'like', '%' . Request::get('occupation') . '%');
        }

        if (!empty(Request::get('address'))) {
            $return = $return->where('address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=',  Request::get('gender'));
        }
        $return =  $return->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
    }
    static public function getDosen()
    {
        $return =  self::select('users.*')
            ->where('user_type', '=', 2)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }

        if (!empty(Request::get('material_status'))) {
            $return = $return->where('material_status', 'like', '%' . Request::get('material_status') . '%');
        }

        if (!empty(Request::get('address'))) {
            $return = $return->where('address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=',  Request::get('gender'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        $return =  $return->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
    }

    static public function getDosenMatkul()
    {
        $return =  self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);

        $return =  $return->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }


    static public function getStudent()
    {
        $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'kurikulum.name as semester_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->join('kurikulum', 'kurikulum.id', '=', 'users.semester_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('semester'))) {
            $return = $return->where('kurikulum.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('class'))) {
            $return = $return->where('class.name', 'like', '%' . Request::get('class') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=',  Request::get('gender'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        $return =  $return->orderBy('id', 'desc')
            ->paginate(10);
        return $return;
    }


    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('face_recognition_api/upload/profile/' . $this->profile_pic)) {
            return url('face_recognition_api/upload/profile/' . $this->profile_pic);
        } else {
            return url('face_recognition_api/upload/profile/user.png');
        }
    }

    public function getProfileDirect()
    {
        if (!empty($this->profile_pic) && file_exists('face_recognition_api/upload/profile/' . $this->profile_pic)) {
            return url('face_recognition_api/upload/profile/' . $this->profile_pic);
        } else {
            return url('face_recognition_api/upload/profile/user.png');
        }
    }
    static public function getSearchStudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name'))  || !empty(Request::get('email'))) {
            $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);
            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', '=',  Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
            }


            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
            }

            $return =  $return->orderBy('users.id', 'desc')
                ->limit(50)
                ->get();
            return $return;
        }
    }
    static public function getMyStudent($parent_id)
    {
        $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }
    static public function getDosenStudent($dosen_id)
    {
        $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $dosen_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }
    static public function getDosenStudent2($dosen_id)
    {
        $return =  self::select('users.*', 'matkul.name as matkul_name')
            ->join('matkul', 'matkul.id', '=', 'users.class_id')
            ->join('matkul_dosen', 'matkul_dosen.matkul_id', '=', 'matkul.id')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $dosen_id)
            ->where('users.is_delete', '=', 0);
        $return =  $return->orderBy('users.id', 'desc')
            ->groupBy('users.id')
            ->paginate(20);
        return $return;
    }


    static public function getStudentClass($class_id, $student_id)
    {
        $return =  self::select('users.*', 'users.name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.id', '=', $student_id)
            ->where('users.class_id', '=', $class_id)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }
    static public function getClassStudent($class_id)
    {
        $return =  self::select('users.*', 'users.name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.class_id', '=', $class_id)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }
    static public function getDosenClass($dosen_id)
    {
        $return =  self::select('users.*', 'users.name')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0)
            ->where('users.id', '=', $dosen_id)
            ->orderBy('users.id', 'desc')
            ->get();
        return $return;
    }

    static public function getPresensi($student_id, $class_id, $tgl_presensi, $matkul_id)
    {
        return presensiModel::where('student_id', '=', $student_id)->where('class_id', '=', $class_id)->where('tgl_presensi', '=', $tgl_presensi)->where('matkul_id', '=', $matkul_id)->first();
    }
}
