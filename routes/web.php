<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\OlahNilaiController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::post('/verify-face', [AuthController::class, 'verifyFace']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword']);

Route::group(['middleware' => 'common'], function () {
    Route::get('chat', [ChatController::class, 'chat']);
    Route::post('submit_message', [ChatController::class, 'submit_message']);
    Route::post('get_chat_windows', [ChatController::class, 'get_chat_windows']);
    Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user']);
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // admin
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    // student 
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    // Dosen
    Route::get('admin/dosen/list', [DosenController::class, 'list']);
    Route::get('admin/dosen/add', [DosenController::class, 'add']);
    Route::post('admin/dosen/add', [DosenController::class, 'insert']);
    Route::get('admin/dosen/edit/{id}', [DosenController::class, 'edit']);
    Route::post('admin/dosen/edit/{id}', [DosenController::class, 'update']);
    Route::get('admin/dosen/delete/{id}', [DosenController::class, 'delete']);


    // parent 
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my-children/{id}', [ParentController::class, 'myChildren']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);


    // class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    // matkul url
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // assign subject
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

    // TimeTable
    Route::get('admin/class_timetable/list', [ClassTimeTableController::class, 'list']);
    Route::post('admin/class_timetable/delete', [ClassTimeTableController::class, 'delete'])->name('class-timetable.delete');
    Route::post('admin/class_timetable/get_subject', [ClassTimeTableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimeTableController::class, 'insert_update']);


    // assign dosen class
    Route::get('admin/assign_class_dosen/list', [AssignClassController::class, 'list']);
    Route::get('admin/assign_class_dosen/add', [AssignClassController::class, 'add']);
    Route::post('admin/assign_class_dosen/add', [AssignClassController::class, 'insert']);
    Route::get('admin/assign_class_dosen/edit/{id}', [AssignClassController::class, 'edit']);
    Route::post('admin/assign_class_dosen/edit/{id}', [AssignClassController::class, 'update']);
    Route::get('admin/assign_class_dosen/delete/{id}', [AssignClassController::class, 'delete']);
    Route::get('admin/assign_class_dosen/edit_single/{id}', [AssignClassController::class, 'edit_single']);
    Route::post('admin/assign_class_dosen/edit_single/{id}', [AssignClassController::class, 'update_single']);

    //  Ujian
    Route::get('admin/examinations/exam/list', [ExaminationController::class, 'exam_list']);
    Route::get('admin/examinations/exam/add', [ExaminationController::class, 'exam_add']);
    Route::post('admin/examinations/exam/add', [ExaminationController::class, 'exam_insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationController::class, 'exam_edit']);
    Route::post('admin/examinations/exam/add', [ExaminationController::class, 'exam_insert']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationController::class, 'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationController::class, 'exam_delete']);

    // jadwal ujian
    Route::get('admin/examinations/exam_schedule', [ExaminationController::class, 'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationController::class, 'exam_schedule_insert']);
    // Route::post('admin/examinations/submit_mark', [ExaminationController::class, 'submit_mark']);
    // Route::post('admin/examinations/single_submit_mark', [ExaminationController::class, 'single_submit_mark']);

    // penilaian 
    Route::get('admin/penilaian/list', [OlahNilaiController::class, 'olah_nilai']);
    Route::get('admin/penilaian/mark_register', [OlahNilaiController::class, 'mark_register']);
    Route::post('admin/penilaian/penilaian_insert', [OlahNilaiController::class, 'nilai_insert']);
    Route::post('admin/penilaian/single_submit_mark', [OlahNilaiController::class, 'single_submit_nilai']);

    // presensi
    Route::get('admin/presensi/student', [PresensiController::class, 'presensi_mahasiswa']);
    Route::get('admin/presensi/dosen', [PresensiController::class, 'presensi_dosen']);
    Route::get('admin/presensi/report', [PresensiController::class, 'laporan_presensi']);
    Route::post('admin/presensi/report_excel', [PresensiController::class, 'laporan_presensi_excel']);
    Route::post('admin/presensi/student/save', [PresensiController::class, 'presensi_mahasiswa_save']);
    Route::post('admin/presensi/dosen/save', [PresensiController::class, 'presensi_dosen_save']);
    Route::post('admin/presensi/get_subject', [ClassTimeTableController::class, 'get_subject']);

    // Komunikasi
    Route::get('admin/komunikasi/pengumuman', [PengumumanController::class, 'Pengumuman']);
    Route::get('admin/komunikasi/pengumuman/add', [PengumumanController::class, 'AddPengumuman']);
    Route::post('admin/komunikasi/pengumuman/add', [PengumumanController::class, 'InsertPengumuman']);
    Route::get('admin/komunikasi/pengumuman/edit/{id}', [PengumumanController::class, 'EditPengumuman']);
    Route::post('admin/komunikasi/pengumuman/edit/{id}', [PengumumanController::class, 'UpdatePengumuman']);
    Route::get('admin/komunikasi/pengumuman/delete/{id}', [PengumumanController::class, 'DeletePengumuman']);

    // Tugas
    Route::get('admin/tugas/penugasan', [TugasController::class, 'Penugasan']);
    Route::get('admin/tugas/penugasan/add', [TugasController::class, 'AddPenugasan']);
    Route::post('admin/tugas/penugasan/add', [TugasController::class, 'InsertPenugasan']);
    Route::get('admin/tugas/penugasan/edit/{id}', [TugasController::class, 'EditPenugasan']);
    Route::post('admin/tugas/penugasan/edit/{id}', [TugasController::class, 'UpdatePenugasan']);
    Route::get('admin/tugas/penugasan/delete/{id}', [TugasController::class, 'DeletePenugasan']);
    Route::post('admin/ajax_get_matkul', [TugasController::class, 'ajax_get_matkul']);
    Route::get('admin/tugas/penugasan/submitted/{id}', [TugasController::class, 'SubmittedPenugasan']);

    Route::get('admin/tugas/penugasan_report', [TugasController::class, 'PenugasanReport']);

    // Mark Grade
    Route::get('admin/penilaian/mark_grade', [OlahNilaiController::class, 'mark_grade']);
    Route::get('admin/penilaian/mark_grade_add', [OlahNilaiController::class, 'mark_grade_add']);
    Route::post('admin/penilaian/mark_grade_add', [OlahNilaiController::class, 'mark_grade_insert']);
    Route::get('admin/penilaian/mark_grade/edit/{id}', [OlahNilaiController::class, 'mark_grade_edit']);
    Route::post('admin/penilaian/mark_grade/edit/{id}', [OlahNilaiController::class, 'mark_grade_update']);
    Route::get('admin/penilaian/mark_grade/delete/{id}', [OlahNilaiController::class, 'mark_grade_delete']);

    Route::get('admin/perizinan/{presensi_id}/{class_id}/{matkul_id}/{student_id}', [PerizinanController::class, 'admin_perizinan_studentID']);
    Route::post('admin/perizinan/{presensi_id}/{class_id}/{matkul_id}/{student_id}', [PerizinanController::class, 'SubmitPerizinanUpdate']);


    // change password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);
});
Route::group(['middleware' => 'dosen'], function () {
    // auth
    Route::get('dosen/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('dosen/change_password', [UserController::class, 'change_password']);
    Route::post('dosen/change_password', [UserController::class, 'update_change_password']);
    Route::get('dosen/account', [UserController::class, 'MyAccount']);
    Route::post('dosen/account', [UserController::class, 'UpdateMyAccountDosen']);


    // Route::post('dosen/my_class_matkul', [UserController::class, 'MyClassMatkul']);
    Route::get('dosen/my_matkul', [AssignClassController::class, 'MySubjectStudent']);
    Route::get('dosen/my_student_list', [StudentController::class, 'MyStudentList']);
    Route::get('dosen/my_exam_timetable', [ExaminationController::class, 'MyExamDosen']);
    Route::get('dosen/my_class_subject/class_timetable/{class_id}/{matkul_id}', [ClassTimeTableController::class, 'myClassDosen']);
    Route::get('dosen/my_calendar', [CalendarController::class, 'CalendarDosen']);

    Route::get('dosen/mark_register', [OlahNilaiController::class, 'mark_register_dosen']);
    // Route::post('dosen/submit_mark', [OlahNilaiController::class, 'submit_mark']);
    Route::post('dosen/single_submit_mark', [OlahNilaiController::class, 'single_submit_nilai']);

    // presensi 
    Route::get('dosen/presensi/student', [PresensiController::class, 'presensi_mahasiswa_dosen']);
    Route::get('dosen/presensi/my_presensi', [PresensiController::class, 'MyPresensiDosen']);
    Route::post('dosen/presensi/save', [PresensiController::class, 'presensi_dosen_save']);
    Route::get('dosen/perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_dosen']);
    Route::post('dosen/perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'SubmitPerizinanInsertDosen']);
    Route::get('dosen/detail_perizinan/{presensi_id}/{dosen_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_dosenID']);
    Route::get('dosen/presensi/{class_id}/{matkul_id}/{student_id}/{week_id}', [PresensiController::class, 'PresensiDosen']);
    Route::post('dosen/presensi/save', [PresensiController::class, 'PresensiStudentSave']);

    Route::get('dosen/pengumuman', [PengumumanController::class, 'pengumuman_dosen']);

    // Tugas
    Route::get('dosen/tugas/penugasan', [TugasController::class, 'PenugasanDosen']);
    Route::get('dosen/tugas/penugasan/add', [TugasController::class, 'AddPenugasanDosen']);
    Route::post('dosen/tugas/penugasan/add', [TugasController::class, 'InsertPenugasanDosen']);
    Route::get('dosen/tugas/penugasan/edit/{id}', [TugasController::class, 'EditPenugasanDosen']);
    Route::post('dosen/tugas/penugasan/edit/{id}', [TugasController::class, 'UpdatePenugasanDosen']);
    Route::get('dosen/tugas/penugasan/delete/{id}', [TugasController::class, 'DeletePenugasanDosen']);
    Route::post('dosen/ajax_get_matkul', [TugasController::class, 'ajax_get_matkulDosen']);
    Route::get('dosen/tugas/penugasan/submitted/{id}', [TugasController::class, 'SubmittedPenugasanDosen']);

    // materi
    Route::get('dosen/tugas/materi', [TugasController::class, 'materiDosen']);
    Route::get('dosen/tugas/materi/add', [TugasController::class, 'AddmateriDosen']);
    Route::post('dosen/tugas/materi/add', [TugasController::class, 'InsertmateriDosen']);
    Route::get('dosen/tugas/materi/edit/{id}', [TugasController::class, 'EditmateriDosen']);
    Route::post('dosen/tugas/materi/edit/{id}', [TugasController::class, 'UpdatemateriDosen']);
    Route::get('dosen/tugas/materi/delete/{id}', [TugasController::class, 'DeletemateriDosen']);
    Route::post('dosen/ajax_get_matkul', [TugasController::class, 'ajax_get_matkulDosen']);
});
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
    Route::get('student/account', [UserController::class, 'MyAccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);

    Route::get('student/my_class', [ClassTimeTableController::class, 'myClassStudent']);
    Route::get('student/my_subject', [SubjectController::class, 'mySubjectStudent']);
    Route::get('student/my_exam', [ExaminationController::class, 'ExamStudent']);
    Route::get('student/my_calendar', [CalendarController::class, 'CalendarStudent']);
    Route::get('student/my_calendar/{id}', [CalendarController::class, 'CalendarStudentGet']);

    Route::get('student/my_exam_result', [OlahNilaiController::class, 'ExamResultStudent']);
    Route::get('student/my_exam_result/print', [OlahNilaiController::class, 'ExamResultStudentPrint']);
    Route::get('student/my_presensi', [PresensiController::class, 'MyPresensiStudent']);
    Route::get('student/presensi/{class_id}/{matkul_id}/{student_id}/{week_id}', [PresensiController::class, 'PresensiStudent']);
    Route::post('student/presensi/save', [PresensiController::class, 'PresensiStudentSave']);
    Route::post('student/face-recognition', [PresensiController::class, 'faceRecognition']);

    Route::get('student/pengumuman', [PengumumanController::class, 'pengumuman_student']);
    Route::get('student/perizinan/{presensi_id}/{student_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_student']);
    Route::post('student/perizinan/{presensi_id}/{student_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'SubmitPerizinanInsert']);
    Route::get('student/detail_perizinan/{presensi_id}/{student_id}/{class_id}/{matkul_id}', [PerizinanController::class, 'perizinan_studentID']);
    // Route::get('student/perizinan', [PerizinanController::class, 'perizinan_student_add']);

    Route::get('student/my_materi', [TugasController::class, 'materiStudent']);
    Route::get('student/my_tugas', [TugasController::class, 'PenugasanStudent']);
    Route::get('student/my_tugas/submit_tugas/{id}', [TugasController::class, 'SubmitTugas']);
    Route::post('student/my_tugas/submit_tugas/{id}', [TugasController::class, 'SubmitTugasInsert']);
    Route::get('student/my_submited_tugas', [TugasController::class, 'SubmitedTugasStudent']);
});
Route::group(['middleware' => 'ortu'], function () {
    Route::get('ortu/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('ortu/change_password', [UserController::class, 'change_password']);
    Route::post('ortu/change_password', [UserController::class, 'update_change_password']);
    Route::get('ortu/account', [UserController::class, 'MyAccount']);
    Route::post('ortu/account', [UserController::class, 'UpdateMyAccountOrtu']);

    Route::get('ortu/my_student', [ParentController::class, 'myStudentParent']);
    Route::get('ortu/my_student/subject/{student_id}', [SubjectController::class, 'ParentSubjectStudent']);
    Route::get('ortu/my_student/calendar/{student_id}', [CalendarController::class, 'ChildrenCalendar']);
    Route::get('ortu/my_student/exam_student/{student_id}', [ExaminationController::class, 'ExamMyChildren']);
    Route::get('ortu/my_student/exam_result/{student_id}', [OlahNilaiController::class, 'ExamResultChildren']);
    Route::get('ortu/my_student/subject/class_timetable/{class_id}/{matkul_id}/{student_id}', [ClassTimeTableController::class, 'myClassChild']);

    Route::get('ortu/pengumuman', [PengumumanController::class, 'pengumuman_ortu']);
});
