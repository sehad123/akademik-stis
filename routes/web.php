<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword']);

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

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
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationController::class, 'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationController::class, 'exam_delete']);


    Route::get('admin/examinations/exam_schedule', [ExaminationController::class, 'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationController::class, 'exam_schedule_insert']);

    // change password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);
});
Route::group(['middleware' => 'dosen'], function () {
    Route::get('dosen/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('dosen/change_password', [UserController::class, 'change_password']);
    Route::post('dosen/change_password', [UserController::class, 'update_change_password']);
    Route::get('dosen/account', [UserController::class, 'MyAccount']);
    Route::post('dosen/account', [UserController::class, 'UpdateMyAccountDosen']);
    Route::post('dosen/my_class_matkul', [UserController::class, 'MyClassMatkul']);
    Route::get('dosen/my_matkul', [AssignClassController::class, 'MySubjectStudent']);
    Route::get('dosen/my_student_list', [StudentController::class, 'MyStudentList']);
    Route::get('dosen/my_exam_timetable', [ExaminationController::class, 'MyExamDosen']);
    Route::get('dosen/my_class_subject/class_timetable/{class_id}/{matkul_id}', [ClassTimeTableController::class, 'myClassDosen']);
    Route::get('dosen/my_calendar', [CalendarController::class, 'CalendarDosen']);
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
    Route::get('ortu/my_student/subject/class_timetable/{class_id}/{matkul_id}/{student_id}', [ClassTimeTableController::class, 'myClassChild']);
});
