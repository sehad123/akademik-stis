<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\MatkulDosenModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AssignClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MatkulDosenModel::getRecord();
        $data['header_title'] = 'Dosen Class Assign';
        return view('admin.assign_class_dosen.list', $data);
    }
    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getDosen'] = User::getDosenMatkul();
        $data['header_title'] = 'Add New Dosen Matkul ';
        return view('admin.assign_class_dosen.add', $data);
    }
    public function insert(Request $request)
    {
        if (!empty($request->dosen_id)) {
            foreach ($request->dosen_id as $dosen_id) {
                $countAlready = MatkulDosenModel::getFirstAlready($request->matkul_id, $request->dosen_id);
                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new MatkulDosenModel;
                    $save->matkul_id = $request->matkul_id;
                    $save->class_id = $request->class_id;
                    $save->dosen_id = $dosen_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_class_dosen/list')->with('success', 'Matkul Dosen berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Matkul Kelas gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $getRecord = MatkulDosenModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignDosenID'] =  MatkulDosenModel::getAssignDosenID($getRecord->matkul_id);
            $data['getDosen'] = User::getDosenMatkul();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Edit Dosen Matkul ';
            return view('admin.assign_class_dosen.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {

        MatkulDosenModel::deleteSubject($request->class_id);

        if (!empty($request->dosen_id)) {
            foreach ($request->dosen_id as $dosen_id) {
                $countAlready = MatkulDosenModel::getFirstAlready($request->matkul_id, $request->dosen_id);
                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = new MatkulDosenModel;
                    $save->matkul_id = $request->matkul_id;
                    $save->class_id = $request->class_id;
                    $save->dosen_id = $dosen_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
        }

        return redirect('admin/assign_class_dosen/list')->with('success', "Matkul Dosen Berhasil diupdate");
    }

    public function delete($id)
    {
        $user = MatkulDosenModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/assign_class_dosen/list')->with('success', "Matkul Kelas Berhasil dihapus");
    }

    public function edit_Single($id)
    {
        $getRecord = MatkulDosenModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getDosen'] = User::getDosenMatkul();
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Dosen Matkul ';
            return view('admin.assign_class_dosen.edit_single', $data);
        } else {
            abort(404);
        }
    }

    public function update_single($id, Request $request)
    {
        $countAlready = MatkulDosenModel::getFirstAlready($request->matkul_id, $request->dosen_id);
        if (!empty($countAlready)) {
            $countAlready->status = $request->status;
            $countAlready->save();
            return redirect('admin/assign_class_dosen/list')->with('success', "Status berhasil diupdate");
        } else {
            $subject = MatkulDosenModel::getSingle($id);
            $subject->matkul_id = $request->matkul_id;
            $subject->dosen_id = $request->dosen_id;
            $subject->class_id = $request->class_id;
            $subject->status = $request->status;
            $subject->save();
            return redirect('admin/assign_class_dosen/list')->with('success', "Matkul Dosen Berhasil diupdate");
        }
    }

    public function MySubjectStudent()
    {
        $data['getRecord'] = MatkulDosenModel::getMyClass(Auth::user()->id);
        $data['header_title'] = 'My Class Matkul';
        return view('dosen.my_matkul', $data);
    }
}
