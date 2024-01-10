<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\MatkulDosenModel;
use App\Models\SubmitTugasModel;
use App\Models\TugasModel;
use Illuminate\Http\Request;
use Auth;
use Str;

class TugasController extends Controller
{
    public function PenugasanReport()
    {
        $data['getRecord'] = SubmitTugasModel::getRecordTugas();
        $data['header_title'] = "Laporan Penugasan";
        return view('admin.penugasan.laporan', $data);
    }
    public function Penugasan()
    {
        $data['getRecord'] = TugasModel::getRecord();
        $data['header_title'] = "Penugasan  ";
        return view('admin.penugasan.list', $data);
    }
    public function AddPenugasan()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add Penugasan  ";
        return view('admin.penugasan.add', $data);
    }
    public function ajax_get_matkul(Request $request)
    {
        $class_id = $request->class_id;
        $getMatkul = ClassMatkulModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Matkul </option>';
        foreach ($getMatkul as $value) {
            $html .= '<option value="' . $value->matkul_id . '">' . $value->matkul_name . ' </option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }

    public function InsertPenugasan(Request $request)
    {
        $save = new TugasModel;
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = $request->deadline;
        $save->description = $request->description;
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
        return redirect('admin/tugas/penugasan')->with('success', "Penugasan Berhasil Ditambahkan");
    }

    public function EditPenugasan($id)
    {
        $getRecord = TugasModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModel::getClass();
        $data['getMatkul'] = ClassMatkulModel::MySubject($getRecord->class_id);
        $data['header_title'] = "Edit Penugasan  ";
        return view('admin.penugasan.edit', $data);
    }

    public function UpdatePenugasan($id, Request $request)
    {
        $save = TugasModel::getSingle($id);
        $save->class_id = $request->class_id;
        $save->matkul_id = $request->matkul_id;
        $save->tanggal = $request->tanggal;
        $save->deadline = $request->deadline;
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
        return redirect('admin/tugas/penugasan')->with('success', "Penugasan Berhasil Diedit");
    }


    public function DeletePenugasan($id)
    {
        $save = TugasModel::getSingle($id);

        $save->delete();
        return redirect('admin/tugas/penugasan')->with('success', "Penugasan Berhasil Dihapus");
    }

    public function PenugasanDosen()
    {
        $getClass = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $c = array();
        foreach ($getClass as $class) {
            $c[] = $class->class_id;
        }
        $data['getRecord'] = TugasModel::getRecordDosen($c);
        $data['header_title'] = "Penugasan  ";
        return view('dosen.penugasan.list', $data);
    }
    public function AddPenugasanDosen()
    {
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);

        $data['header_title'] = "Add Penugasan  ";
        return view('dosen.penugasan.add', $data);
    }
    public function ajax_get_matkulDosen(Request $request)
    {


        $class_id = $request->class_id;
        $getMatkul = ClassMatkulModel::MySubject($class_id);
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
        $data['getClass'] = MatkulDosenModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getMatkul'] = ClassMatkulModel::MySubject($getRecord->class_id);
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
        $data['getRecord'] = TugasModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "Penugasan  ";
        return view('student.my_tugas', $data);
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
}
