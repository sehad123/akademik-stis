<?php

namespace App\Http\Controllers;

use App\Models\ClassMatkulModel;
use App\Models\ClassModel;
use App\Models\ExamModel;
use App\Models\MatkulDosenModel;
use App\Models\PengumumanModel;
use App\Models\presensiModel;
use App\Models\SubjectModel;
use App\Models\SubmitTugasModel;
use App\Models\TugasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if (Auth::user()->user_type == 1) {
            $data['totalAdmin'] = User::getTotalUser(1);
            $data['totalOrtu'] = User::getTotalUser(4);
            $data['totalPengumuman'] = PengumumanModel::getTotalPengumumanDosen(Auth::user()->user_type);
            $data['totalDosen'] = User::getTotalUser(2);
            $data['totalStudent'] = User::getTotalUser(3);
            $data['totalExam'] = ExamModel::getTotalUjian();
            $data['totalClass'] = ClassModel::getTotalClass();
            $data['totalMatkul'] = SubjectModel::getTotalMatkul();
            return view('admin.dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            $data['totalPengumuman'] = PengumumanModel::getTotalPengumumanDosen(Auth::user()->user_type);
            $data['totalClass'] = MatkulDosenModel::getTotalClassDosen(Auth::user()->id);
            $data['totalMatkul'] = MatkulDosenModel::getTotalMatkulDosen(Auth::user()->id);
            return view('dosen.dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            $data['totalPengumuman'] = PengumumanModel::getTotalPengumumanDosen(Auth::user()->user_type);
            $data['totalMatkul'] = ClassMatkulModel::getTotalMatkulStudent(Auth::user()->class_id, Auth::user()->semester_id);
            $data['totalTugas'] = TugasModel::getTotalTugasStudent(Auth::user()->class_id, Auth::user()->id,);
            $data['totalSubmitted'] = SubmitTugasModel::getTotalSubmittedStudent(Auth::user()->id);
            $data['totalKehadiran'] = presensiModel::getTotalPresensiStudent(Auth::user()->id);
            return view('student.dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            $data['getRecord'] = PengumumanModel::getRecordUser(Auth::user()->user_type);
            $data['header_title'] = "Pengumuman  ";
            return view('ortu.pengumuman_ortu', $data);
        }
    }
}
