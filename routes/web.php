<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthenticationController::class, 'Login']);



Route::get('/student-grade', [StudentController::class, 'viewStudentGrade']);
Route::get('/student-profile', [StudentController::class, 'viewStudentProfile']);
Route::get('/student-calendar', [StudentController::class, 'viewStudentCalendar']);
Route::get('/add-student-form', [StudentController::class, 'viewAddStudentForm']);


Route::get('/add-student', [StudentController::class, 'addStudent'])->name('student.add');
Route::post('/add-student', [StudentController::class, 'saveStudent'])->name('save.student');
Route::get('/list-student', [StudentController::class, 'studentList'])->name('student.list');
Route::get('/list-student1', [StudentController::class, 'studentList1'])->name('student.list');
Route::get('/list-student2', [StudentController::class, 'studentList2'])->name('student.list');



Route::get('/edit-student/{id}', [StudentController::class, 'editStudent'])->name('student.edit');
Route::post('/update-student', [StudentController::class, 'updateStudent'])->name('update.student');
Route::get('/remove-student/{id}', [StudentController::class, 'removeStudent'])->name('student.remove');


Route::get('/multi-form', [ClassroomController::class, 'showMultiForm']);
Route::get('/add-classroom', [ClassroomController::class, 'addClassroom'])->name('classroom.add');
Route::post('/add-classroom', [ClassroomController::class, 'saveClassroom'])->name('save.classroom');
Route::get('/list-classroom', [ClassroomController::class, 'classroomList'])->name('classroom.list');
Route::get('/list-lecturerclass', [ClassroomController::class, 'viewLecturerClassList'])->name('classroom.list');


Route::get('/add-subject', [SubjectController::class, 'addSubject'])->name('subject.add');
Route::post('/add-subject', [SubjectController::class, 'saveSubject'])->name('save.subject');
Route::get('/list-subject', [SubjectController::class, 'subjectList'])->name('subject.list');


Route::get('/lecturer-profile', [LecturerController::class, 'viewLecturerProfile']);
Route::get('/lecturer-grade', [LecturerController::class, 'viewLecturerGrade']);
Route::get('/lecturer-calendar', [LecturerController::class, 'viewLecturerCalendar']);
Route::get('/add-lecturer-form', [LecturerController::class, 'viewAddLecturerForm']);
Route::get('/add-lecturer', [LecturerController::class, 'addLecturer'])->name('lecturer.add');
Route::post('/add-lecturer', [LecturerController::class, 'saveLecturer'])->name('save.lecturer');
Route::get('/list-lecturer', [LecturerController::class, 'lecturerList'])->name('lecturer.list');



Route::get('/add-student-classroom', [StudentController::class, 'addStudentToClassroom'])->name('studentClassroom.add');
Route::post('/add-student-classroom', [StudentController::class, 'saveStudentToClassroom'])->name('save.studentClassroom');
Route::get('/list-student-classroom', [StudentController::class, 'studentClassroomList'])->name('studentClassroom.list');

Route::get('/add-lecturer-subject', [LecturerController::class, 'addLecturerSubject'])->name('lecturerSubject.add');
Route::post('/add-lecturer-subject', [LecturerController::class, 'saveLecturerSubject'])->name('save.lecturerSubject');
