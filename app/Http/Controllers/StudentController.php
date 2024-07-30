<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Str;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = 'Student List';
        return view('admin.student.list', $data);
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Edit Admin';
            return view('admin.student.edit', $data);
        } else {
            abort(404);
        }
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            // 'height' => 'max:10',
            // 'weight' => 'max:10',
            // 'blood_group' => 'max:10',
            'mobile_number' => 'max:12|min:8',
            'religion' => 'max:10',
            // 'caste' => 'max:15',
            'admission_number' => 'max:15',
            // 'roll_number' => 'max:10',
        ]);
        $student = new User;
        $student->name = trim($request->name);
        // $student->last_name = trim($request->last_name);
        $student->email = trim($request->email);
        $student->status = 0;
        $student->gender = trim($request->gender);
        // $student->weight = trim($request->weight);
        // $student->height = trim($request->height);
        // $student->blood_group = trim($request->blood_group);
        $student->religion = trim($request->religion);
        $student->caste = trim($request->caste);
        $student->mobile_number = trim($request->mobile_number);
        // if (!empty($request->admission_date)) {

        //     $student->admission_date = trim($request->admission_date);
        // }
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->admission_number = trim($request->admission_number);
        $student->class_id = trim($request->class_id);
        // $student->roll_number = trim($request->roll_number);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;

        $student->save();

        return redirect('admin/student/list')->with('success', "Mahasiswa Berhasil Ditambahkan");
    }
    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            // 'height' => 'max:10',
            // 'weight' => 'max:10',
            // 'blood_group' => 'max:10',
            'mobile_number' => 'max:12|min:8',
            'religion' => 'max:10',
            // 'caste' => 'max:15',
            'admission_number' => 'max:15',
            // 'roll_number' => 'max:10',
        ]);
        $student =  User::getSingle($id);
        $student->name = trim($request->name);
        // $student->last_name = trim($request->last_name);
        $student->email = trim($request->email);
        $student->status = trim($request->status);
        $student->gender = trim($request->gender);
        // $student->weight = trim($request->weight);
        // $student->height = trim($request->height);
        // $student->blood_group = trim($request->blood_group);
        $student->religion = trim($request->religion);
        $student->caste = trim($request->caste);
        $student->mobile_number = trim($request->mobile_number);
        // if (!empty($request->admission_date)) {

        //     $student->admission_date = trim($request->admission_date);
        // }
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->file('profile_pic'))) {
            if (!empty($student->getProfile())) {
                unlink('upload/profile/' . $student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->admission_number = trim($request->admission_number);
        $student->class_id = trim($request->class_id);
        // $student->roll_number = trim($request->roll_number);
        if (!empty($request->password)) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect('admin/student/list')->with('success', "Mahasiswa Berhasil Diupdate");
    }



    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/student/list')->with('success', "Mahasiswa Berhasil dihapus");
    }

    public function myStudentList()
    {
        $data['getRecord'] = User::getDosenStudent(Auth::user()->id);
        $data['header_title'] = 'My Student List';
        return view('dosen.my_student_list', $data);
    }
}
