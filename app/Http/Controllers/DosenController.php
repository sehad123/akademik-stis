<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Str;

class DosenController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getDosen();
        $data['header_title'] = 'dosen List';
        return view('admin.dosen.list', $data);
    }
    public function add()
    {
        // $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New dosen';
        return view('admin.dosen.add', $data);
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if (!empty($data['getRecord'])) {
            // $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Edit Admin';
            return view('admin.dosen.edit', $data);
        } else {
            abort(404);
        }
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:12|min:8',
            'material_status' => 'max:50',
        ]);
        $dosen = new User;
        $dosen->name = trim($request->name);
        $dosen->last_name = trim($request->last_name);
        $dosen->email = trim($request->email);
        $dosen->status = trim($request->status);
        $dosen->qualification = trim($request->qualification);
        $dosen->material_status = trim($request->material_status);
        $dosen->gender = trim($request->gender);
        $dosen->permanent_address = trim($request->permanent_address);
        $dosen->height = trim($request->height);
        $dosen->note = trim($request->note);
        $dosen->address = trim($request->address);
        $dosen->work_experience = trim($request->work_experience);
        $dosen->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) {

            $dosen->admission_date = trim($request->admission_date);
        }
        if (!empty($request->date_of_birth)) {
            $dosen->date_of_birth = trim($request->date_of_birth);
        }

        $dosen->password = Hash::make($request->password);
        $dosen->user_type = 2;
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $dosen->profile_pic = $filename;
        }


        $dosen->save();

        return redirect('admin/dosen/list')->with('success', "Dosen Berhasil Ditambahkan");
    }
    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $dosen =  User::getSingle($id);
        $dosen->name = trim($request->name);
        $dosen->last_name = trim($request->last_name);
        $dosen->email = trim($request->email);
        $dosen->material_status = trim($request->material_status);
        $dosen->status = trim($request->status);
        $dosen->qualification = trim($request->qualification);
        $dosen->gender = trim($request->gender);
        $dosen->permanent_address = trim($request->permanent_address);
        $dosen->height = trim($request->height);
        $dosen->note = trim($request->note);
        $dosen->address = trim($request->address);
        $dosen->work_experience = trim($request->work_experience);
        $dosen->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) {

            $dosen->admission_date = trim($request->admission_date);
        }
        if (!empty($request->date_of_birth)) {
            $dosen->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($dosen->getProfile())) {
                unlink('upload/profile/' . $dosen->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $dosen->profile_pic = $filename;
        }
        if (!empty($request->password)) {
            $dosen->password = Hash::make($request->password);
        }
        $dosen->save();

        return redirect('admin/dosen/list')->with('success', "Dosen Berhasil Diupdate");
    }



    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/dosen/list')->with('success', "Dosen Berhasil dihapus");
    }
    public function AssignStudentdosenDelete($id)
    {
        $user = User::getSingle($id);
        $user->dosen_id = null;
        $user->save();

        return redirect()->back()->with('success', " Mahasiswa Orang tua Berhasil dihapus");
    }

    public function myChildren($id)
    {
        $data['getdosen'] = User::getSingle($id);
        $data['dosen_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);

        $data['header_title'] = 'dosen Children List';
        return view('admin.dosen.my_children', $data);
    }
    public function AssignStudentdosen($student_id, $dosen_id)
    {
        $student = User::getSingle($student_id);
        $student->dosen_id = $dosen_id;
        $student->save();
        $data['header_title'] = 'dosen Children List';
        // return view('admin.dosen.my_children', $data);
        return redirect()->back()->with('success', " Mahasiswa Berhasil ditambahkan");
    }
}
