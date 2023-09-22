<?php

use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\ScholasticController;
use App\Http\Controllers\ScholasticDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectDetailController;
use App\Http\Controllers\LecturersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/a', function () {
    return view('welcome');
});

Route::post('/doc-file-excel', [SiteController::class, 'handleReadExcelFile']);



Route::prefix('/')->group(function () {
    Route::get('/', [SiteController::class, 'home_page']);
    Route::get('/dangnhap', [SiteController::class, 'showLoginPage'])->name('login.show');
    Route::post('/dangnhap', [SiteController::class, 'handleLogin'])->name('login.handle');
    Route::get('/dangxuat', [SiteController::class, 'logout']);

    Route::get('/thongke', [SiteController::class, 'getStatisticalData'])->name("getStatistical_handle");
    Route::post('test', [SiteController::class, 'test'])->name('update.data');
});

Route::prefix('/namhoc')->group(function () {
    Route::post('/themnamhoc', [ScholasticController::class, 'addScholastic'])->name('scholastic.add');
    Route::get('/xoanamhoc', [ScholasticController::class, 'deleteScholastic'])->name('scholastic.delete');
    Route::post('/suanamhoc', [ScholasticController::class, 'editScholastic'])->name('scholastic.edit');


    Route::get('/laydanhsachnamhoc', [ScholasticController::class, 'getAllScholastic'])->name('scholastic.list');
});

Route::prefix('/hocki')->group(function () {
    Route::post('/themhocki', [SemesterController::class, 'addSemester'])->name('semester.add');
    Route::get('/xoahocki', [SemesterController::class, 'deleteSemester'])->name('semester.delete');
    Route::get('/laydanhsachhocki', [SemesterController::class, 'getAllSemester'])->name('semester.list');
    Route::post('/suahocki', [SemesterController::class, 'editSemester'])->name('semester.edit');

    Route::get('/lay-hoc-ki-theo-nam-hoc', [SemesterController::class, 'getSemesterListByScholastic'])->name('semeterByScholastic.list');
    Route::get('/lay-hoc-ki-theo-nganh-hoc', [SemesterController::class, 'getSemesterListByMajor'])->name('semeterByMajor.list');
});

Route::prefix('/nganhhoc')->group(function () {
    Route::post('/themnganhhoc', [MajorsController::class, 'addMajor'])->name('major.add');
    Route::get('/xoanganhhoc', [MajorsController::class, 'deleteMajor'])->name('major.delete');
    Route::get('/laydanhsachnganh', [MajorsController::class, 'getAllMajors'])->name('major.list');
    Route::post('/suanganhhoc', [MajorsController::class, 'editMajor'])->name('major.edit');

    Route::get('/lay-nganh-hoc-theo-nam-hoc', [MajorsController::class, 'getMajorListByScholastic'])->name('majorByScholastic.list');
});

Route::prefix('/monhoc')->group(function () {
    Route::get('/them-mon-hoc-bang-excel-file', [SubjectsController::class, 'showAddSubjectByExcelFile'])->name('subject_excel.add');
    Route::get('/xu-ly-them-mon-hoc-bang-excel-file', [SubjectsController::class, 'handleAddSubjectByExcelFile'])->name('subject_excel_handle.add');

    Route::get('them-mon-hoc-bang-form', [SubjectsController::class, 'showAddSubjectByForm']);
    Route::post('xu-ly-them-mon-hoc-bang-form', [SubjectsController::class, 'handleAddSubjectByForm'])->name('subject_form_add.handle');

    Route::get('/laydanhsachmonhoc', [SubjectsController::class, 'getAllSubjects'])->name('subject.list');

    Route::get('/xoamonhoc', [SubjectsController::class, 'deleteSubject'])->name('subject.delete');
    Route::post('/suamonhoc', [SubjectsController::class, 'editSubject'])->name('subject.edit');
});

Route::prefix('/chitietmonhoc')->group(function () {
    Route::get('/xoachitietmonhoc', [SubjectDetailController::class, 'deleteSubjectDetail'])->name('subject_detail.delete');
    Route::get('/laydanhsachchitietmonhoc', [SubjectDetailController::class, 'getSubjectDetailList'])->name('subject_detail.list');
    Route::post('/suagiangvienphutrachmonhoc', [SubjectDetailController::class, 'editLecturerInSubjectDetail'])->name('subjectDetail_lecturer.edit');
});

Route::prefix('/giangvien')->group(function () {
    // Route::post('/themnganhhoc', [MajorsController::class, 'addMajor'])->name('major.add');
    // Route::get('/xoanganhhoc', [MajorsController::class, 'deleteMajor'])->name('major.delete');
    Route::get('/laydanhsachgiangvien', [LecturersController::class, 'getLecturersList'])->name('lecturers.list');
    // Route::post('/suanganhhoc', [MajorsController::class, 'editMajor'])->name('major.edit');
});


// Route::get('/test', [MajorsController::class, 'getAllMajors']);
