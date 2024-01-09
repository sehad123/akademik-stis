<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use App\Models\PesanPengumumanModel;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PengumumanController extends Controller
{
    public function Pengumuman()
    {
        $data['getRecord'] = PengumumanModel::getRecord();
        $data['header_title'] = "Pengumuman  ";
        return view('admin.komunikasi.pengumuman.list', $data);
    }
    public function AddPengumuman()
    {
        // $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Add Pengumuman  ";

        return view('admin.komunikasi.pengumuman.add', $data);
    }
    public function InsertPengumuman(Request $request)
    {
        $save = new PengumumanModel;
        $save->judul = $request->judul;
        $save->tgl_pengumuman = $request->tgl_pengumuman;
        $save->tgl_publish = $request->tgl_publish;
        $save->pesan = $request->pesan;
        $save->created_by = Auth::user()->id;
        $save->save();

        if (!empty($request->pesan_to)) {
            foreach ($request->pesan_to as $pesan_to) {
                $pesan = new PesanPengumumanModel;
                $pesan->pengumuman_id = $save->id;
                $pesan->pesan_to = $pesan_to;
                $pesan->save();
            }
        }

        return redirect('admin/komunikasi/pengumuman')->with('success', "Pengumuman Berhasil Ditambahkan");
    }
    public function EditPengumuman($id)
    {

        $data['getRecord'] = PengumumanModel::getSingle($id);
        $data['header_title'] = "Edit Pengumuman  ";
        return view('admin.komunikasi.pengumuman.edit', $data);
    }
    public function UpdatePengumuman($id, Request $request)
    {

        $save = PengumumanModel::getSingle($id);
        $save->judul = $request->judul;
        $save->tgl_pengumuman = $request->tgl_pengumuman;
        $save->tgl_publish = $request->tgl_publish;
        $save->pesan = $request->pesan;
        $save->save();

        PesanPengumumanModel::DeleteRecord($id);
        if (!empty($request->pesan_to)) {
            foreach ($request->pesan_to as $pesan_to) {
                $pesan = new PesanPengumumanModel;
                $pesan->pengumuman_id = $save->id;
                $pesan->pesan_to = $pesan_to;
                $pesan->save();
            }
        }

        return redirect('admin/komunikasi/pengumuman')->with('success', "Pengumuman Berhasil Diedit");
    }

    public function DeletePengumuman($id)
    {
        $save = PengumumanModel::getSingle($id);

        $save->delete();
        return redirect('admin/komunikasi/pengumuman')->with('success', "Pengumuman Berhasil Dihapus");
    }

    public function pengumuman_student()
    {
        $data['getRecord'] = PengumumanModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Pengumuman  ";
        return view('student.pengumuman_student', $data);
    }
    public function pengumuman_dosen()
    {
        $data['getRecord'] = PengumumanModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Pengumuman  ";
        return view('dosen.pengumuman_dosen', $data);
    }
    public function pengumuman_ortu()
    {
        $data['getRecord'] = PengumumanModel::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = "Pengumuman  ";
        return view('ortu.pengumuman_ortu', $data);
    }
}
