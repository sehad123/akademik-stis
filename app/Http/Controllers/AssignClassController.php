<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassMatkulModel;
use App\Models\MatkulDosenModel;
use App\Models\SemesterClassModel;

class AssignClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MatkulDosenModel::getRecord();
        $data['header_title'] = 'Dosen Class Assign';
        return view('admin.assign_class_dosen.list', $data);
    }
    public function add(Request $request)
    {

        $data['getSemester'] = ExamModel::getSemester();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        if (!empty($request->class_id && !empty($request->semester_id))) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id);
        }
        $data['getDosen'] = User::getDosenMatkul();
        $data['header_title'] = 'Add New Dosen Matkul ';
        return view('admin.assign_class_dosen.add', $data);
    }


    public function insert(Request $request)
    {
        if (!empty($request->dosen_id)) {
            $save = new MatkulDosenModel;
            $save->matkul_id = $request->matkul_id;
            $save->semester_id = $request->semester_id;
            $save->class_id = $request->class_id;
            $save->dosen_id = $request->dosen_id;
            $save->status = "Active";
            $save->created_by = Auth::user()->id;
            $save->save();

            return redirect('admin/assign_class_dosen/list')->with('success', 'Matkul Dosen berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Matkul Kelas gagal ditambahkan');
        }
    }



    public function edit(Request $request, $id)
    {
        $getRecord = MatkulDosenModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignDosenID'] =  MatkulDosenModel::getAssignDosenID($getRecord->matkul_id);
            $data['getDosen'] = User::getDosenMatkul();
            $data['getSemester'] = ExamModel::getSemester();
            $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
            if (!empty($request->class_id && !empty($request->semester_id))) {
                $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id);
            }
            $data['header_title'] = 'Edit Dosen Matkul ';
            return view('admin.assign_class_dosen.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        // Hapus data lama berdasarkan class_id sebelum menambahkan yang baru
        MatkulDosenModel::deleteSubject($request->class_id);

        if (!empty($request->dosen_id)) {
            foreach ($request->dosen_id as $dosen_id) {
                // Periksa apakah sudah ada entri untuk matkul_id dan dosen_id
                $countAlready = MatkulDosenModel::getFirstAlready($request->matkul_id, $dosen_id);

                // if (!empty($countAlready)) {
                // Jika sudah ada, perbarui status
                $countAlready->status = $request->status;
                $countAlready->save();
                // } 
                // else {
                // Jika belum ada, tambahkan entri baru
                $save = new MatkulDosenModel;
                $save->matkul_id = $request->matkul_id;
                $save->class_id = $request->class_id;
                $save->semester_id = $request->semester_id;
                $save->dosen_id = $dosen_id;
                $save->status = $request->status;
                $save->created_by = Auth::user()->id;
                $save->save();
                // }
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
            $data['getSemester'] = ExamModel::getSemester();
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
            $subject->semester_id = $request->semester_id;
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
