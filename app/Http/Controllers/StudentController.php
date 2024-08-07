<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use Hash;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\ClassMatkulModel;
use App\Models\SemesterClassModel;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = 'Student List';
        return view('admin.student.list', $data);
    }
    public function add(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        if (!empty($request->semester_id)) {
        }
        // $data['getClass'] = ClassModel::getClass();
        $data['getSemester'] = ExamModel::getSemester();
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['getClass'] = ClassModel::getClass();
            $data['getSemester'] = ExamModel::getSemester();
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
            $file->move('face_recognition_api/upload/profile/', $filename);

            $student->profile_pic = $filename;
        }
        $student->admission_number = trim($request->admission_number);
        $student->class_id = trim($request->class_id);
        $student->semester_id = trim($request->semester_id);
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
        if ($request->hasFile('profile_pic')) {
            // Periksa apakah kolom profile_pic tidak null atau kosong
            if (!empty($student->profile_pic)) {
                $filePath = 'face_recognition_api/upload/profile/' . $student->profile_pic;
                // Hapus file jika ada
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Proses unggah file baru
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('face_recognition_api/upload/profile/', $filename);

            // Perbarui kolom profile_pic dengan nama file baru
            $student->profile_pic = $filename;
        }

        $student->admission_number = trim($request->admission_number);
        $student->class_id = trim($request->class_id);
        $student->semester_id = trim($request->semester_id);

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
