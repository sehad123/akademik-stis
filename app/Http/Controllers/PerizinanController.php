<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\PerizinanModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Str;

class PerizinanController extends Controller
{
    public function list_izin_student()
    {

        // $data['getRecord'] = TugasModel::getRecordMateriStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "Perizinan  ";
        return view('student.list_izin', $data);
    }
    public function perizinan_studentID($presensi_id)
    {
        $data['getData'] = PerizinanModel::getRecord($presensi_id);
        $data['header_title'] = "Perizinan  ";
        return view('student.perizinan_detail', $data);
    }

    public function perizinan_student($presensi_id, $class_id, $matkul_id, $student_id)
    {
        // $data['getClass'] = ClassModel::getSingle($class_id);
        // $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        // $data['getMahasiswa'] =  User::getSingle($student_id);
        $classSubject =   PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id, $student_id);
        $data['getIzin'] = $classSubject;
        $data['header_title'] = "add Perizinan";
        return view('student.submit_izin', $data);
    }
    public function SubmitPerizinanInsert(Request $request, $presensi_id, $student_id, $class_id, $matkul_id)
    {

        // $studentId =  Auth::user()->id;


        $save = new PerizinanModel;
        $save->student_id = $student_id;
        $save->presensi_id = $presensi_id;
        $save->class_id = $class_id;
        $save->matkul_id = $matkul_id;
        $save->alasan = $request->alasan;
        $save->status = "belum diterima";
        if (!empty($request->file('bukti'))) {
            $ext = $request->file('bukti')->getClientOriginalExtension();
            $file =  $request->file('bukti');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/perizinan/', $filename);
            $save->bukti = $filename;
        }

        $save->save();
        return redirect('student/my_presensi')->with('success', "Perizinan Berhasil Disubmit");
    }

    public function admin_perizinan_studentID($presensi_id, $class_id, $matkul_id, $student_id)
    {

        // $data['getId'] = PerizinanModel::getSingle($presensi_id);
        // $data['getClass'] = ClassModel::getSingle($class_id);
        // $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        // $data['getStudent'] =  User::getSingle($student_id);
        $classSubject =   PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id, $student_id);
        $data['getIzin'] = $classSubject;
        $data['header_title'] = "Perizinan  ";
        return view('admin.perizinan.detail', $data);
    }
    public function SubmitPerizinanUpdate($presensi_id, $class_id, $matkul_id, $student_id, Request $request)
    {
        $getIzin = PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id, $student_id);

        // Check if $getIzin is not null before proceeding
        if (!$getIzin) {
            return redirect()->back()->with('error', 'Perizinan not found');
        }

        $getIzin->status = $request->status;
        $getIzin->save();

        return redirect('admin/presensi/report')->with('success', 'Perizinan Berhasil Diupdate');
    }
}