<?php

use App\Http\Controllers\AuthControllerHP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;



// Route untuk mengambil data user yang terautentikasi
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk autentikasi
Route::get('/', [AuthControllerHP::class, 'login']);
Route::post('/login', [AuthControllerHP::class, 'AuthLogin']);
Route::get('/csrf-token', [AuthController::class, 'getToken']);
Route::get('/logout', [AuthControllerHP::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword']);

Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
Route::get('dosen/dashboard', [DashboardController::class, 'dashboard']);
Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
Route::get('admin/account', [UserController::class, 'MyAccount']);



Route::get('admin/presensi/report', [PresensiController::class, 'laporan_presensi']);
Route::get('admin/presensi/report_dosen', [PresensiController::class, 'laporan_presensiDosen']);

// Route untuk dosen
Route::get('dosen/change_password', [UserController::class, 'change_password']);
Route::post('dosen/change_password', [UserController::class, 'update_change_password']);
Route::get('dosen/account', [UserController::class, 'MyAccount']);
Route::post('dosen/account', [UserController::class, 'UpdateMyAccountDosen']);
Route::get('dosen/my_class_subject/class_timetable/{class_id}/{matkul_id}', [ClassTimeTableController::class, 'myClassDosen']);
Route::get('dosen/my_calendar', [CalendarController::class, 'CalendarDosen']);
Route::get('dosen/presensi/my_presensi', [PresensiController::class, 'MyPresensiDosen']);
Route::get('dosen/perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_dosen']);
Route::post('dosen/perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'SubmitPerizinanInsertDosen']);
Route::get('dosen/detail_perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_dosenID']);
Route::get('dosen/presensi/{class_id}/{matkul_id}/{dosen_id}/{week_id}', [PresensiController::class, 'PresensiDosen']);
Route::post('dosen/presensi/save', [PresensiController::class, 'PresensiDosenSave']);

// Route untuk mahasiswa

Route::get('student/change_password', [UserController::class, 'change_password']);
Route::post('student/change_password', [UserController::class, 'update_change_password']);
Route::get('student/account', [UserController::class, 'MyAccount']);
Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);
Route::get('student/my_presensi', [PresensiController::class, 'MyPresensiStudent']);
Route::get('student/my_calendar', [CalendarController::class, 'CalendarStudentHP']);
Route::get('student/presensi/{class_id}/{matkul_id}/{student_id}/{week_id}', [PresensiController::class, 'PresensiStudent']);
Route::post('student/presensi/save', [PresensiController::class, 'PresensiStudentSave']);
