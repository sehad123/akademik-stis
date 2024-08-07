<?php

namespace App\Http\Controllers;

use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\SemesterClassModel;
use Illuminate\Http\Request;
use Auth;

class SemesterClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SemesterClassModel::getRecord();
        $data['header_title'] = 'subject Assign List';
        return view('admin.semester_class.list', $data);
    }
    public function add()
    {
        $data['getSemester'] = ExamModel::getSemester();
        $data['getClass'] =  ClassModel::getClass();
        $data['header_title'] = 'Add New Semester Class ';
        return view('admin.semester_class.add', $data);
    }
    public function insert(Request $request)
    {
        if (!empty($request->class_id)) {
            $classSemester = []; // Inisialisasi array untuk menyimpan array asosiatif

            foreach ($request->class_id as $class_id) {
                $countAlready = SemesterClassModel::getFirstAlready($request->semester_id, $class_id);

                if (!empty($countAlready)) {
                    $countAlready->status = 0;
                    $countAlready->save();
                } else {
                    $save = [
                        'semester_id' => $request->semester_id,
                        'class_id' => $class_id,
                        'status' => 0,
                        'created_by' =>  Auth::user()->id,
                    ];

                    // Menambahkan array asosiatif ke dalam array
                    $classSemester[] = $save;
                }
            }

            // Menggunakan createMany untuk menyimpan array asosiatif ke database
            SemesterClassModel::insert($classSemester);

            return redirect('admin/semester_class/list')->with('success', 'Class berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', ' Kelas gagal ditambahkan');
        }
    }
    public function edit($id)
    {
        $getRecord = SemesterClassModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] =  SemesterClassModel::getAssignSubjectID($getRecord->semester_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSemester'] = ExamModel::getSemester();
            $data['header_title'] = 'Edit Semester Kelas ';
            return view('admin.semester_class.edit', $data);
        } else {
            abort(404);
        }
    }

    // public function update(Request $request)
    // {
    //     SemesterClassModel::deleteSubject($request->semester_id);

    //     if (!empty($request->matkul_id)) {
    //         $classMatkuls = []; // Inisialisasi array untuk menyimpan array asosiatif

    //         foreach ($request->matkul_id as $matkul_id) {
    //             $countAlready = SemesterClassModel::getFirstAlready($request->semester_id, $matkul_id);

    //             if (!empty($countAlready)) {
    //                 $countAlready->status = $request->status;
    //                 $countAlready->save();
    //             } else {
    //                 $save = [
    //                     'semester_id' => $request->semester_id,
    //                     'class_id' => $request->class_id,
    //                     'status' => $request->status,
    //                     'created_by' => Auth::user()->id,
    //                 ];

    //                 // Menambahkan array asosiatif ke dalam array
    //                 $classMatkuls[] = $save;
    //             }
    //         }

    //         // Menggunakan createMany untuk menyimpan array asosiatif ke database
    //         SemesterClassModel::insert($classMatkuls);
    //     }

    //     return redirect('admin/semester_class/list')->with('success', "Matkul Berhasil diupdate");
    // }


    public function delete($id)
    {
        $user = SemesterClassModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/semester_class/list')->with('success', "Matkul Kelas Berhasil dihapus");
    }

    // public function edit_Single($id)
    // {
    //     $getRecord = SemesterClassModel::getSingle($id);
    //     if (!empty($getRecord)) {
    //         $data['getRecord'] = $getRecord;
    //         $data['getClass'] = ClassModel::getClass();
    //         $data['getSubject'] = SubjectModel::getSubject();
    //         $data['header_title'] = 'Add New subject ';
    //         return view('admin.assign_subject.edit_single', $data);
    //     } else {
    //         abort(404);
    //     }
    // }

    // public function update_single($id, Request $request)
    // {
    //     $countAlready = SemesterClassModel::getFirstAlready($request->class_id, $request->matkul_id);
    //     if (!empty($countAlready)) {
    //         $countAlready->status = $request->status;
    //         $countAlready->save();
    //         return redirect('admin/semester_class/list')->with('success', "Status berhasil diupdate");
    //     } else {
    //         $subject = SemesterClassModel::getSingle($id);
    //         $subject->class_id = $request->class_id;
    //         $subject->matkul_id = $request->matkul_id;
    //         $subject->status = $request->status;
    //         $subject->save();
    //         return redirect('admin/semester_class/list')->with('success', "Kelas Matkul Berhasil diupdate");
    //     }
}
