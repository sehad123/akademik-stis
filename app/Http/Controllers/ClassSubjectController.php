<?php

namespace App\Http\Controllers;

use App\Models\SemesterClassModel;
use Auth;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\ClassMatkulModel;

class ClassSubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassMatkulModel::getRecord();
        $data['header_title'] = 'subject Assign List';
        return view('admin.assign_subject.list', $data);
    }
    public function add(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();
        if (!empty($request->semester_id)) {
            $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
        }
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = 'Add New subject ';
        return view('admin.assign_subject.add', $data);
    }
    public function insert(Request $request)
    {
        if (!empty($request->matkul_id)) {
            $classMatkuls = []; // Inisialisasi array untuk menyimpan array asosiatif

            foreach ($request->matkul_id as $matkul_id) {
                $countAlready = ClassMatkulModel::getFirstAlready($request->class_id, $request->semester_id, $matkul_id);

                if (!empty($countAlready)) {
                    $countAlready->status = 0;
                    $countAlready->save();
                } else {
                    $save = [
                        'semester_id' => $request->semester_id,
                        'class_id' => $request->class_id,
                        'matkul_id' => $matkul_id,
                        'status' => 0,
                        'created_by' =>  Auth::user()->id,
                    ];

                    // Menambahkan array asosiatif ke dalam array
                    $classMatkuls[] = $save;
                }
            }

            // Menggunakan createMany untuk menyimpan array asosiatif ke database
            ClassMatkulModel::insert($classMatkuls);

            return redirect('admin/assign_subject/list')->with('success', 'Matkul berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Matkul Kelas gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $getRecord = ClassMatkulModel::getSingle($id);
        $data['getSemester'] = ExamModel::getSemester();

        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] =  ClassMatkulModel::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            // if (!empty($request->semester_id)) {
            //     $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
            // }
            // $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Add New subject ';
            return view('admin.assign_subject.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        ClassMatkulModel::deleteSubject($request->class_id, $request->semester_id);

        if (!empty($request->matkul_id)) {
            $classMatkuls = []; // Inisialisasi array untuk menyimpan array asosiatif

            foreach ($request->matkul_id as $matkul_id) {
                $countAlready = ClassMatkulModel::getFirstAlready($request->class_id, $request->semester_id, $matkul_id);

                if (!empty($countAlready)) {
                    $countAlready->status = $request->status;
                    $countAlready->save();
                } else {
                    $save = [
                        'semester_id' => $request->semester_id,
                        'class_id' => $request->class_id,
                        'matkul_id' => $matkul_id,
                        'status' => $request->status,
                        'created_by' => Auth::user()->id,
                    ];

                    // Menambahkan array asosiatif ke dalam array
                    $classMatkuls[] = $save;
                }
            }

            // Menggunakan createMany untuk menyimpan array asosiatif ke database
            ClassMatkulModel::insert($classMatkuls);
        }

        return redirect('admin/assign_subject/list')->with('success', "Matkul Berhasil diupdate");
    }


    public function delete($id)
    {
        $user = ClassMatkulModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/assign_subject/list')->with('success', "Matkul Kelas Berhasil dihapus");
    }

    // public function edit_Single($id)
    // {
    //     $getRecord = ClassMatkulModel::getSingle($id);
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
    //     $countAlready = ClassMatkulModel::getFirstAlready($request->class_id, $request->matkul_id);
    //     if (!empty($countAlready)) {
    //         $countAlready->status = $request->status;
    //         $countAlready->save();
    //         return redirect('admin/assign_subject/list')->with('success', "Status berhasil diupdate");
    //     } else {
    //         $subject = ClassMatkulModel::getSingle($id);
    //         $subject->class_id = $request->class_id;
    //         $subject->matkul_id = $request->matkul_id;
    //         $subject->status = $request->status;
    //         $subject->save();
    //         return redirect('admin/assign_subject/list')->with('success', "Kelas Matkul Berhasil diupdate");
    //     }
}
