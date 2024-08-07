<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = 'subject List';
        return view('admin.subject.list', $data);
    }
    public function mySubjectStudent()
    {
        $data['getRecord'] = ClassMatkulModel::MySubject(Auth::user()->class_id, Auth::user()->semester_id);
        $data['header_title'] = 'My Subject';
        return view('student.my_subject', $data);
    }
    public function ParentSubjectStudent($student_id)
    {
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;
        $data['getRecord'] = ClassMatkulModel::MySubject($user->class_id, $user->semester_id);
        $data['header_title'] = 'My Parent Subject';
        return view('ortu.my_student_subject', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New subject ';
        return view('admin.subject.add', $data);
    }
    public function insert(Request $request)
    {
        $save = new SubjectModel;
        $save->name = $request->name;
        $save->status = "Active";
        $save->type = $request->type;
        $save->created_by = Auth::user()->id;
        $save->save();


        return redirect('admin/subject/list')->with('success', 'Matkul berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);

        if (!empty($data['getRecord'])) {

            $data['header_title'] = 'Edit subject';
            return view('admin.subject.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        // request()->validate([
        //     'name' => 'required|name|unique:subject,' . $id
        // ]);
        $subject = SubjectModel::getSingle($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->save();

        return redirect('admin/subject/list')->with('success', "Matkul Berhasil diupdate");
    }

    public function delete($id)
    {
        $user = SubjectModel::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/subject/list')->with('success', "Matkul Berhasil dihapus");
    }
}
