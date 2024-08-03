<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Str;
use Hash;

class ParentController extends Controller
{

    public function list()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = 'parent List';
        return view('admin.parent.list', $data);
    }
    public function myStudentParent()
    {
        $id = Auth::user()->id;
        $data['getRecord'] = User::getMyStudent($id);

        $data['header_title'] = 'My Children';
        return view('ortu.my_student', $data);
    }
    public function add()
    {
        // $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New parent';
        return view('admin.parent.add', $data);
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if (!empty($data['getRecord'])) {
            // $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Edit Admin';
            return view('admin.parent.edit', $data);
        } else {
            abort(404);
        }
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'min:10|max:12',
            'occupation' => 'max:20',
            'address' => 'max:50',
        ]);
        $parent = new User;
        $parent->name = trim($request->name);
        // $parent->last_name = trim($request->last_name);
        $parent->email = trim($request->email);
        $parent->status = trim($request->status);
        $parent->gender = trim($request->gender);
        $parent->address = trim($request->address);
        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file =  $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('face_recognition_api/upload/profile/', $filename);

            $parent->profile_pic = $filename;
        }
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;

        $parent->save();

        return redirect('admin/parent/list')->with('success', "Orang tua Mahasiswa Berhasil Ditambahkan");
    }
    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:12|min:8',
        ]);
        $parent =  User::getSingle($id);
        $parent->name = trim($request->name);
        // $parent->last_name = trim($request->last_name);
        $parent->email = trim($request->email);
        $parent->status = trim($request->status);
        $parent->address = trim($request->address);
        $parent->occupation = trim($request->occupation);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);
        if ($request->hasFile('profile_pic')) {
            // Periksa apakah kolom profile_pic tidak null atau kosong
            if (!empty($parent->profile_pic)) {
                $filePath = 'face_recognition_api/upload/profile/' . $parent->profile_pic;
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
            $parent->profile_pic = $filename;
        }

        if (!empty($request->password)) {
            $parent->password = Hash::make($request->password);
        }
        $parent->save();

        return redirect('admin/parent/list')->with('success', "Orang tua Mahasiswa Berhasil Diupdate");
    }



    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/parent/list')->with('success', "Orang tua Mahasiswa Berhasil dihapus");
    }
    public function AssignStudentParentDelete($id)
    {
        $user = User::getSingle($id);
        $user->parent_id = null;
        $user->save();

        return redirect()->back()->with('success', " Mahasiswa Orang tua Berhasil dihapus");
    }

    public function myChildren($id)
    {
        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);

        $data['header_title'] = 'parent Children List';
        return view('admin.parent.my_children', $data);
    }
    public function AssignStudentParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        $data['header_title'] = 'parent Children List';
        // return view('admin.parent.my_children', $data);
        return redirect()->back()->with('success', " Mahasiswa Berhasil ditambahkan");
    }
}
