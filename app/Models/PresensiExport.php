<?php

namespace App\Exports;

use App\Models\presensiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromQuery, WithHeadings
{
    public function query()
    {
        // Anda dapat menyesuaikan query sesuai dengan kebutuhan
        return presensiModel::query()->select('student_name', 'class_name', 'matkul_name', 'presensi_type', 'tgl_presensi', 'bobot');
    }

    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'Kelas',
            'Mata Kuliah',
            'Presensi',
            'Tanggal Presensi',
            'Bobot Kehadiran',
        ];
    }
}
