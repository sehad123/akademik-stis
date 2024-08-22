<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\WeekModel;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use App\Models\presensiModel;
use App\Models\PerizinanModel;
use App\Models\ClassMatkulModel;
use App\Models\ClassTimeTableModel;
use App\Models\ExamModel;
use App\Models\SemesterClassModel;

class PresensiController extends Controller
{
    public function laporan_presensi()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getRecord'] = presensiModel::getRecord();
        $data['header_title'] = "Laporan Presensi Mahasiswa ";
        return view('admin.presensi.laporan', $data);
    }

    public function laporan_presensi_mahasiswa(Request $request)
    {
        $data['getSemester'] = ExamModel::getSemester();
        $data['getClass'] =  SemesterClassModel::MySubjectSemester($request->semester_id);

        if (!empty($request->class_id && !empty($request->semester_id))) {
            $data['getSubject'] =  ClassMatkulModel::MySubject($request->class_id, $request->semester_id);
        }

        $data['totalMahasiswa'] = User::getTotalMahasiswa($request->semester_id, $request->class_id);
        $data['totalPresensi'] = presensiModel::countTotalPresensi(Auth::user()->id, $request->class_id, $request->matkul_id, $request->tgl_presensi);

        // Only fetch records if the search button is clicked (i.e., request parameters exist)
        if ($request->filled(['class_id', 'semester_id', 'matkul_id', 'tgl_presensi'])) {
            $data['getRecord'] = presensiModel::getRecordMahasiswa(Auth::user()->id, $request->class_id, $request->matkul_id, $request->tgl_presensi);
        } else {
            $data['getRecord'] = collect(); // Empty collection if no search performed
        }

        $data['header_title'] = "Laporan Presensi Mahasiswa";
        return view('dosen.presensi.laporan_presensi_mahasiswa', $data);
    }

    public function laporan_presensiDosen()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['getRecord'] = presensiModel::getRecordDosenn();
        $data['header_title'] = "Laporan Presensi Dosen ";
        return view('admin.presensi.laporan_dosen', $data);
    }


    public function updateBobot($id, Request $request)
    {
        $request->validate([
            'bobot' => 'required|integer|between:0,100',
        ]);

        $presensi = presensiModel::findOrFail($id);
        $presensi->bobot = $request->bobot;
        $presensi->save();

        return response()->json(['success' => true]);
    }

    public function updatePresensi($id, Request $request)
    {
        $request->validate([
            'presensi_type' => 'required|integer|between:1,6',
        ]);

        $presensi = presensiModel::findOrFail($id);
        $presensi->presensi_type = $request->presensi_type;

        if ($presensi->presensi_type == 1) {
            $presensi->bobot = 100;
        } else if ($presensi->presensi_type == 2) {
            $presensi->bobot = 60;
        } else if ($presensi->presensi_type == 3) {
            $presensi->bobot = 50;
        } else if ($presensi->presensi_type == 4 || $presensi->presensi_type == 5) {
            $presensi->bobot = 60;
        } else if ($presensi->presensi_type == 6) {
            $presensi->bobot = 0;
        }

        $presensi->save();

        return response()->json(['success' => true, 'bobot' => $presensi->bobot]);
    }

    public function MyPresensiStudent()
    {
        $data['perizinan'] = PerizinanModel::getRecord(Auth::user()->id);
        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Presensi ";

        return view('student.my_presensi', $data);
    }
    public function MyPresensiDosen()
    {
        $data['perizinan'] = PerizinanModel::getRecordDosen(Auth::user()->id);
        $data['getRecord'] = presensiModel::getRecorddDosen(Auth::user()->id);
        $data['header_title'] = "My Presensi ";

        return view('dosen.presensi.my_presensi', $data);
    }

    public function PresensiStudent($class_id, $matkul_id, $student_id, $week_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $data['getMahasiswa'] =  User::getSingle($student_id);
        $data['getDay'] =  WeekModel::getSingle($week_id);
        $data['getStudent'] = User::getStudentClass($class_id, $student_id);
        // $data['getMyJadwal'] = $this->getJadwalStudent(Auth::user()->class_id);
        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubject($c->id, Auth::user()->semester_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['dosen_name'] = $classSubject->dosen_name; // Add dosen_name
                    $dataW['dosen_id'] = $classSubject->dosen_id; // Add dosen_name
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyJadwal'] = $result;


        $data['getRecord'] = presensiModel::getRecordStudent(Auth::user()->id);
        // dd($data['getRecord']);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "My Presensi ";

        return view('student.presensi', $data);
    }
    public function PresensiDosen($class_id, $matkul_id, $dosen_id, $week_id)
    {
        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getMatkul'] =  SubjectModel::getSingle($matkul_id);
        $data['getDosen'] =  User::getSingle($dosen_id);
        $data['getDay'] =  WeekModel::getSingle($week_id);
        $data['getStudent'] = User::getDosenClass($dosen_id);

        // $data['getMyJadwal'] = $this->getJadwalStudent(Auth::user()->class_id);
        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubjectDosen($m->id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject =   ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['dosen_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $data['getMyJadwal'] = $result;


        $data['getRecord'] = presensiModel::getRecordDosen(Auth::user()->id);
        // dd($data['getRecord']);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "My Presensi ";

        return view('dosen.presensi.presensi', $data);
    }


    public function presensiStudentSave(Request $request)
    {
        $student_id = Auth::user()->id;
        $class_id = $request->input('class_id');
        $matkul_id = $request->input('matkul_id');
        $week_id = $request->input('week_id');
        $presensi_type = $request->input('presensi_type');
        $tgl_presensi = now()->toDateString();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $status = $request->input('status'); // Ambil status dari request
        $dosen_id = $request->input('dosen_id'); // Ambil status dari request

        $face_image_name = $request->input('face_image');

        // Titik koordinat target
        $target_latitude = -7.538284413323129;
        $target_longitude = 110.62490576687038;

        // Fungsi untuk menghitung jarak antara dua titik koordinat
        function haversineGreatCircleeDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
        {
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }

        // Validasi input latitude dan longitude jika presensi_type == 1 (Hadir) dan status == "Offline"
        if ($status == "Offline" && $presensi_type == 1) {
            if (empty($latitude) || empty($longitude)) {
                session()->flash('message', 'Lokasi tidak ditemukan, harap mengaktifkan GPS Anda.');
                return response()->json(['status' => 'error'], 400);
            }

            // Hitung jarak dari lokasi pengguna ke titik koordinat target
            $distance = haversineGreatCircleeDistance($latitude, $longitude, $target_latitude, $target_longitude);

            // Validasi jarak (100 meter)
            if ($distance > 100) {
                session()->flash('message', 'Anda berada di luar radius 100 meter dari titik presensi.');
                return response()->json(['status' => 'error'], 400);
            }
        }

        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubject($c->id, Auth::user()->semester_id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject = ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['student_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['dosen_id'] = $classSubject->dosen_id; // Add dosen_name
                    $dataW['dosen_name'] = $classSubject->dosen_name; // Add dosen_name
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $getMyJadwal = $result;

        // Validate that the necessary models are found
        $getClass = ClassModel::getSingle($class_id);
        $getMatkul = SubjectModel::getSingle($matkul_id);
        $getMahasiswa = User::getSingle($student_id);
        $getDay = WeekModel::getSingle($week_id);

        if (!$getMahasiswa || !$getClass || !$getMatkul || !$getDay) {
            session()->flash('message', 'Invalid data provided');
            return response()->json(['status' => 'error'], 400);
        }

        $checkKehadiran = presensiModel::checkPresensi($getMahasiswa->id, $getClass->id, now()->toDateString(), $getMatkul->id, $getDay->id);

        if (!empty($checkKehadiran)) {
            $presensi = $checkKehadiran;
        } else {
            if ($getDay->id != (now()->dayOfWeek + 1) % 7) {
                session()->flash('message', "Anda hanya bisa melakukan presensi pada hari {$getDay->name}");
                return response()->json(['status' => 'error']);
            } else {
                $classSchedule = $getMyJadwal[0]['week'][0];
                $current_time = now()->hour * 60 + now()->minute;
                $start_time = $classSchedule['jam_mulai'] * 60 + $classSchedule['menit_mulai'];
                $end_time = $classSchedule['jam_akhir'] * 60 + $classSchedule['menit_akhir'];

                if ($current_time < $start_time) {
                    session()->flash('message', "Anda hanya bisa melakukan presensi pada jam {$classSchedule['jam_mulai']}");
                    return response()->json(['status' => 'error']);
                } else if ($current_time > $end_time) {
                    session()->flash('message', 'Anda terlambat lebih dari 40 menit, harap lapor BAAK');
                    return response()->json(['status' => 'error']);
                } else {
                    $presensi = new presensiModel;
                    $presensi->student_id = $getMahasiswa->id;
                    $presensi->matkul_id = $getMatkul->id;
                    $presensi->class_id = $getClass->id;
                    $presensi->week_id = $getDay->id;
                    $presensi->id_dosen = $dosen_id;
                    $presensi->tgl_presensi = $tgl_presensi;
                    $presensi->created_by = $getMahasiswa->name;
                    $presensi->latitude = $latitude;
                    $presensi->longtitude = $longitude;
                    $presensi->face_image = $face_image_name;
                    $presensi->created_at = now()->format('h:i A');

                    if ($current_time - $start_time > 30 && $presensi_type == 1) {
                        $presensi->presensi_type = 6; // Tidak Hadir
                        $presensi->bobot = 0;
                        session()->flash('message', 'Anda terlambat lebih dari 30 menit, harap lapor BAAK');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($current_time - $start_time > 20 && $presensi_type == 1) {
                        $presensi->presensi_type = 3; // Terlambat B
                        $presensi->bobot = 50;
                        session()->flash('message', 'Anda terlambat lebih dari 20 menit');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($current_time - $start_time > 15 && $presensi_type == 1) {
                        $presensi->presensi_type = 2; // Terlambat A
                        $presensi->bobot = 75;
                        session()->flash('message', 'Anda terlambat lebih dari 15 menit');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($presensi_type == 4) {
                        $presensi->presensi_type = $presensi_type; // Sakit
                        $presensi->bobot = 60;
                        session()->flash('message', 'Harap upload bukti sakit Anda');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($presensi_type == 5) {
                        $presensi->presensi_type = $presensi_type; // Izin
                        $presensi->bobot = 60;
                        session()->flash('message', 'Harap upload bukti izin Anda');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else {
                        $presensi->presensi_type = $presensi_type; // Hadir
                        $presensi->bobot = 100;
                        session()->flash('message', 'Anda presensi tepat waktu');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    }
                }
            }
        }
    }

    public function presensiDosenSave(Request $request)
    {
        $dosen_id = Auth::user()->id;
        $class_id = $request->input('class_id');
        $matkul_id = $request->input('matkul_id');
        $week_id = $request->input('week_id');
        $presensi_type = $request->input('presensi_type');
        $tgl_presensi = now()->toDateString();
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $status = $request->input('status'); // Ambil status dari request
        $face_image_name = $request->input('face_image');

        // Titik koordinat target
        $target_latitude = -7.538284413323129;
        $target_longitude = 110.62490576687038;

        // Fungsi untuk menghitung jarak antara dua titik koordinat
        function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
        {
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }

        // Validasi input latitude dan longitude jika presensi_type == 1 (Hadir)
        if ($status == "Offline" && $presensi_type == 1) {
            if (empty($latitude) || empty($longitude)) {
                session()->flash('message', 'Lokasi tidak ditemukan, harap mengaktifkan GPS Anda.');
                return response()->json(['status' => 'error'], 400);
            }

            // Hitung jarak dari lokasi pengguna ke titik koordinat target
            $distance = haversineGreatCircleDistance($latitude, $longitude, $target_latitude, $target_longitude);

            // Validasi jarak (100 meter)
            if ($distance > 100) {
                session()->flash('message', 'Anda berada di luar radius 100 meter dari titik presensi.');
                return response()->json(['status' => 'error'], 400);
            }
        }

        $c = ClassModel::getSingle($class_id);
        $m = SubjectModel::getSingle($matkul_id);
        $d = WeekModel::getSingle($week_id);

        $result = array();
        $getRecord = ClassMatkulModel::MySubjectDosen($m->id);
        foreach ($getRecord as $value) {
            $dataS['name'] = $value->matkul_name;

            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach ($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;

                $classSubject = ClassTimeTableModel::getRecordClassMatkul($c->id, $m->id, $d->id);
                if (!empty($classSubject)) {
                    $dataW['start_time'] = $classSubject->start_time;
                    $dataW['end_time'] = $classSubject->end_time;
                    $dataW['room_number'] = $classSubject->room_number;
                    $dataW['dosen_id'] = Auth::user()->id;
                    $dataW['class_id'] = $classSubject->class_id;
                    $dataW['matkul_id'] = $classSubject->matkul_id;
                    $dataW['week_id'] = $classSubject->week_id;
                    $dataW['tanggal'] = $classSubject->tanggal;
                    $dataW['jam_mulai'] = $classSubject->jam_mulai;
                    $dataW['menit_mulai'] = $classSubject->menit_mulai;
                    $dataW['jam_akhir'] = $classSubject->jam_akhir;
                    $dataW['menit_akhir'] = $classSubject->menit_akhir;
                    $dataW['status'] = $classSubject->status;
                    $dataW['link'] = $classSubject->link;
                    $week[] = $dataW;
                }
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
        }
        $getMyJadwal = $result;

        // Validate that the necessary models are found
        $getClass = ClassModel::getSingle($class_id);
        $getMatkul = SubjectModel::getSingle($matkul_id);
        $getDosen = User::getSingle($dosen_id);
        $getDay = WeekModel::getSingle($week_id);

        if (!$getDosen || !$getClass || !$getMatkul || !$getDay) {
            session()->flash('message', 'Invalid data provided');
            return response()->json(['status' => 'error'], 400);
        }

        $checkKehadiran = presensiModel::checkPresensi($getDosen->id, $getClass->id, now()->toDateString(), $getMatkul->id, $getDay->id);

        if (!empty($checkKehadiran)) {
            $presensi = $checkKehadiran;
        } else {
            if ($getDay->id != (now()->dayOfWeek + 1) % 7) {
                session()->flash('message', "Anda hanya bisa melakukan presensi pada hari {$getDay->name}");
                return response()->json(['status' => 'error']);
            } else {
                $classSchedule = $getMyJadwal[0]['week'][0];
                $current_time = now()->hour * 60 + now()->minute;
                $start_time = $classSchedule['jam_mulai'] * 60 + $classSchedule['menit_mulai'];
                $end_time = $classSchedule['jam_akhir'] * 60 + $classSchedule['menit_akhir'];

                if ($current_time < $start_time) {
                    session()->flash('message', "Anda hanya bisa melakukan presensi pada jam {$classSchedule['jam_mulai']}");
                    return response()->json(['status' => 'error']);
                } else if ($current_time > $end_time) {
                    session()->flash('message', 'Anda terlambat lebih dari 40 menit, harap lapor BAAK');
                    return response()->json(['status' => 'error']);
                } else {
                    $presensi = new presensiModel;
                    $presensi->dosen_id = $getDosen->id;
                    $presensi->matkul_id = $getMatkul->id;
                    $presensi->class_id = $getClass->id;
                    $presensi->week_id = $getDay->id;
                    $presensi->tgl_presensi = $tgl_presensi;
                    $presensi->created_by = $getDosen->name;
                    $presensi->latitude = $latitude;
                    $presensi->longtitude = $longitude;
                    $presensi->face_image = $face_image_name;
                    $presensi->created_at = now()->format('h:i A');
                    if ($current_time - $start_time > 30 && $presensi_type == 1) {
                        $presensi->presensi_type = 6; // Tidak Hadir
                        $presensi->bobot = 0;
                        session()->flash('message', 'Anda terlambat lebih dari 30 menit, harap lapor BAAK');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($current_time - $start_time > 20 && $presensi_type == 1) {
                        $presensi->presensi_type = 3; // Terlambat B
                        $presensi->bobot = 50;
                        session()->flash('message', 'Anda terlambat lebih dari 20 menit');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($current_time - $start_time > 15 && $presensi_type == 1) {
                        $presensi->presensi_type = 2; // Terlambat A
                        $presensi->bobot = 75;
                        session()->flash('message', 'Anda terlambat lebih dari 15 menit');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($presensi_type == 4) {
                        $presensi->presensi_type = $presensi_type; // Sakit
                        $presensi->bobot = 60;
                        session()->flash('message', 'Harap upload bukti sakit Anda');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else if ($presensi_type == 5) {
                        $presensi->presensi_type = $presensi_type; // Izin
                        $presensi->bobot = 60;
                        session()->flash('message', 'Harap upload bukti izin Anda');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    } else {
                        $presensi->presensi_type = $presensi_type; // Hadir
                        $presensi->bobot = 100;
                        session()->flash('message', 'Anda presensi tepat waktu');
                        $presensi->save();
                        return response()->json(['status' => 'success']);
                    }

                    // session()->flash('message', 'Anda presensi tepat waktu');
                }
            }
        }
    }
}
