<?php

namespace App\Http\Controllers;

use Str;
use Illuminate\Http\Request;
use App\Models\PerizinanModel;

class PerizinanController extends Controller
{
    public function perizinan_studentID($presensi_id)
    {
        $data['getData'] = PerizinanModel::getRecord($presensi_id);
        $data['header_title'] = "Perizinan  ";
        return view('student.perizinan_detail', $data);
    }
    public function perizinan_dosenID($presensi_id)
    {
        $data['getData'] = PerizinanModel::getRecordDosen($presensi_id);
        $data['header_title'] = "Perizinan  ";
        return view('dosen.perizinan_detail', $data);
    }

    public function perizinan_student($presensi_id, $class_id, $matkul_id)
    {
        $classSubject =   PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id);
        $data['getIzin'] = $classSubject;
        $data['header_title'] = "add Perizinan";
        return view('student.submit_izin', $data);
    }
    public function perizinan_dosen($presensi_id, $class_id, $matkul_id, $dosen_id)
    {
        $classSubject =   PerizinanModel::getRecordClassMatkulDosen($presensi_id, $class_id, $matkul_id, $dosen_id);
        $data['getIzin'] = $classSubject;
        $data['header_title'] = "add Perizinan";
        return view('dosen.submit_izin', $data);
    }
    public function SubmitPerizinanInsert(Request $request, $presensi_id, $student_id, $class_id, $matkul_id)
    {
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
    public function SubmitPerizinanInsertDosen(Request $request, $presensi_id, $dosen_id, $class_id, $matkul_id)
    {
        $save = new PerizinanModel;
        $save->dosen_id = $dosen_id;
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
        return redirect('dosen/presensi/my_presensi')->with('success', "Perizinan Berhasil Disubmit");
    }

    public function admin_perizinan_studentID($presensi_id, $class_id, $matkul_id)
    {
        $classSubject =   PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id);
        $data['getIzin'] = $classSubject;
        $data['header_title'] = "Perizinan  ";
        return view('admin.perizinan.detail', $data);
    }
    public function SubmitPerizinanUpdate($presensi_id, $class_id, $matkul_id, Request $request)
    {
        $getIzin = PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id);
        if (!$getIzin) {
            return redirect()->back()->with('error', 'Perizinan not found');
        }

        $getIzin->status = $request->status;

        $getIzin->save();

        return redirect('admin/presensi/report')->with('success', 'Perizinan Berhasil Diupdate');
    }

    public function SubmitPerizinanUpdateDosen($presensi_id, $class_id, $matkul_id, Request $request)
    {
        $getIzin = PerizinanModel::getRecordClassMatkul($presensi_id, $class_id, $matkul_id);
        if (!$getIzin) {
            return redirect()->back()->with('error', 'Perizinan not found');
        }

        $getIzin->status = $request->status;
        $getIzin->save();

        return redirect('admin/presensi/report')->with('success', 'Perizinan Berhasil Diupdate');
    }
}
