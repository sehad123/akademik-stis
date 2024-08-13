<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\TugasModel;
use Illuminate\Http\Request;
use App\Models\ClassMatkulModel;
use App\Models\MatkulDosenModel;
use App\Models\SubmitTugasModel;
use App\Models\SemesterClassModel;

class TugasController extends Controller
{
    public function PenugasanDosen()
    {
        $getClass = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $c = array();
        foreach ($getClass as $class) {
            $c[] = $class->class_id;
        }
        $data['getRecord'] = TugasModel::getRecordPenugasanDosen();
        $data['header_title'] = "Penugasan  ";
        return view('dosen.penugasan.list', $data);
    }
    public function AddPenugasanDosen(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);

        if (!empty($request->class_id && !empty($request->semester_id))) {

            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
        }

        $data['header_title'] = "Add Penugasan  ";
        return view('dosen.penugasan.add', $data);
    }
    public function ajax_get_matkulDosen(Request $request)
    {


        $class_id = $request->class_id;
        $semester_id = $request->semester_id;
        $getMatkul = ClassMatkulModel::MySubject($class_id, $semester_id);
        $html = '';
        $html .= '<option value="">Select Matkul </option>';
        foreach ($getMatkul as $value) {
            $html .= '<option value="' . $value->matkul_id . '">' . $value->matkul_name . ' </option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }

    public function InsertPenugasanDosen(Request $request)
    {
        $save = new TugasModel;
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = $request->deadline;
        $save->description = $request->description;
        $save->status = 0;
        $save->created_by = Auth::user()->id;

        if (!empty($request->file('document'))) {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file =  $request->file('document');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/tugas/', $filename);

            $save->document = $filename;
        }

        $save->save();
        return redirect('dosen/tugas/penugasan')->with('success', "Penugasan Berhasil Ditambahkan");
    }

    public function EditPenugasanDosen($id)
    {
        $getRecord = TugasModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        // $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        // $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);

        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getMatkul'] = ClassMatkulModel::MySubjectMatkul($getRecord->class_id);
        $data['header_title'] = "Edit Penugasan  ";
        return view('dosen.penugasan.edit', $data);
    }

    public function UpdatePenugasanDosen($id, Request $request)
    {
        $save = TugasModel::getSingle($id);
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = $request->deadline;
        $save->status = 0;
        $save->description = $request->description;

        if (!empty($request->file('document'))) {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file =  $request->file('document');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/tugas/', $filename);

            $save->document = $filename;
        }

        $save->save();
        return redirect('dosen/tugas/penugasan')->with('success', "Penugasan Berhasil Diedit");
    }


    public function DeletePenugasanDosen($id)
    {
        $save = TugasModel::getSingle($id);

        $save->delete();
        return redirect('dosen/tugas/penugasan')->with('success', "Penugasan Berhasil Dihapus");
    }

    public function PenugasanStudent()
    {
        $data['getRecord'] = TugasModel::getRecordTugasStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "Penugasan  ";
        return view('student.my_tugas', $data);
    }
    public function materiStudent()
    {
        $data['getRecord'] = TugasModel::getRecordMateriStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "Penugasan  ";
        return view('student.my_materi', $data);
    }
    public function SubmitTugas($tugas_id)
    {
        $data['getRecord'] = TugasModel::getSingle($tugas_id);
        $data['header_title'] = "Submit Penugasan";
        return view('student.submit_tugas', $data);
    }
    public function SubmitTugasInsert(Request $request, $tugas_id)
    {
        $save = new SubmitTugasModel;
        $save->tugas_id = $tugas_id;
        $save->student_id = Auth::user()->id;
        $save->description = $request->description;
        if (!empty($request->file('document'))) {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file =  $request->file('document');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/tugas/', $filename);
            $save->document = $filename;
        }

        $save->save();
        return redirect('student/my_tugas')->with('success', "Tugas Berhasil Disubmit");
    }
    public function SubmitedTugasStudent()
    {
        $data['getRecord'] = SubmitTugasModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Submited Tugas  ";
        return view('student.my_submited_tugas', $data);
    }

    public function SubmittedPenugasan($tugas_id)
    {
        $tugas = TugasModel::getSingle($tugas_id);
        if (!empty($tugas)) {
            $data['tugas_id'] = $tugas_id;
            $data['getRecord'] = SubmitTugasModel::getRecord($tugas_id);
            $data['header_title'] = "Submitted Tugas  ";
            return view('admin.penugasan.submitted_tugas', $data);
        } else {
            abort(404);
        }
    }
    public function SubmittedPenugasanDosen($tugas_id)
    {
        $tugas = TugasModel::getSingle($tugas_id);
        if (!empty($tugas)) {
            $data['tugas_id'] = $tugas_id;
            $data['getRecord'] = SubmitTugasModel::getRecord($tugas_id);
            $data['header_title'] = "Submitted Tugas  ";
            return view('dosen.penugasan.submitted_tugas', $data);
        } else {
            abort(404);
        }
    }

    // materi dosen

    public function materiDosen()
    {
        $getClass = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $c = array();
        foreach ($getClass as $class) {
            $c[] = $class->class_id;
        }
        $data['getRecord'] = TugasModel::getRecordMateriDosen();
        $data['header_title'] = "materi  ";
        return view('dosen.materi.list', $data);
    }
    public function AddmateriDosen(Request $request)
    {
        // $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);

        $data['getSemester'] = ExamModel::getSemester();

        // $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);

        if (!empty($request->class_id && !empty($request->semester_id))) {

            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
        }

        $data['header_title'] = "Add materi  ";
        return view('dosen.materi.add', $data);
    }

    public function InsertmateriDosen(Request $request)
    {
        $save = new TugasModel;
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = null;
        $save->description = $request->description;
        $save->status = 1;
        $save->created_by = Auth::user()->id;

        if (!empty($request->file('document'))) {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file =  $request->file('document');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/tugas/', $filename);

            $save->document = $filename;
        }

        $save->save();
        return redirect('dosen/tugas/materi')->with('success', "Materi Berhasil Ditambahkan");
    }

    public function EditmateriDosen($id)
    {
        $getRecord = TugasModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getMatkul'] = ClassMatkulModel::MySubjectMatkul($getRecord->class_id);
        $data['header_title'] = "Edit materi  ";
        return view('dosen.materi.edit', $data);
    }

    public function UpdatemateriDosen($id, Request $request)
    {
        $save = TugasModel::getSingle($id);
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = null;
        $save->status = 1;
        $save->description = $request->description;

        if (!empty($request->file('document'))) {
            $ext = $request->file('document')->getClientOriginalExtension();
            $file =  $request->file('document');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/tugas/', $filename);

            $save->document = $filename;
        }

        $save->save();
        return redirect('dosen/tugas/materi')->with('success', "Materi Berhasil Diedit");
    }


    public function DeletMmateriDosen($id)
    {
        $save = TugasModel::getSingle($id);

        $save->delete();
        return redirect('dosen/tugas/materi')->with('success', "Materi Berhasil Dihapus");
    }
}
