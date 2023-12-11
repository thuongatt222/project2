<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\SchoolYearController;
use App\Http\Controllers\Management\MajorController;
use App\Http\Controllers\Management\StudentController;
use App\Http\Controllers\Management\TuitionController;
use App\Http\Controllers\Management\FeeController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home1', [App\Http\Controllers\HomeController::class, 'chartsearch'])->name('chartsearch');
    Route::view('about', 'about')->name('about');

//    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');

    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('school_year')->group(function () {
        Route::get('show', [SchoolYearController::class, 'index'])->name('school_year');
        Route::post('add_school_year', [SchoolYearController::class, 'store'])->name('add.school_year');
        Route::post('update_school_year', [SchoolYearController::class, 'update'])->name('update.school_year');
        Route::post('delete_school_year', [SchoolYearController::class, 'destroy'])->name('delete.school_year');
        Route::get('search_school_year', [SchoolYearController::class, 'search'])->name('search.school_year');
    });

    Route::prefix('major')->group(function () {
        Route::get('show', [MajorController::class, 'index'])->name('major');
        Route::post('add_major', [MajorController::class, 'store'])->name('add.major');
        Route::post('delete_major', [MajorController::class, 'destroy'])->name('delete.major');
        Route::post('update_major', [MajorController::class, 'update'])->name('update.major');
        Route::get('search_major', [MajorController::class, 'search'])->name('search.major');
    });

    Route::prefix('user')->group(function () {
        Route::get('show', [UserController::class, 'index'])->name('user');
        Route::post('add_user', [UserController::class, 'store'])->name('add.user');
        Route::post('delete_user', [UserController::class, 'destroy'])->name('delete.user');
        Route::post('update_user', [UserController::class, 'update'])->name('update.user');
        Route::post('import_user', [UserController::class, 'import'])->name('import.user');
        Route::post('export_user', [UserController::class, 'export'])->name('export.user');
        Route::get('search_user', [UserController::class, 'search'])->name('search.user');

    });

    Route::prefix('student')->group(function () {
        Route::get('show', [StudentController::class, 'index'])->name('student');
        Route::post('add_student', [StudentController::class, 'store'])->name('add.student');
        Route::post('delete_student', [StudentController::class, 'destroy'])->name('delete.student');
        Route::post('update_student', [StudentController::class, 'update'])->name('update.student');
        Route::get('search_student', [StudentController::class, 'search'])->name('search.student');
    });

    Route::prefix('tuition')->group(function () {
        Route::get('show', [TuitionController::class, 'index'])->name('tuition');
        Route::post('delete_tuition', [TuitionController::class, 'destroy'])->name('delete.tuition');
        Route::post('update_tuition', [TuitionController::class, 'update'])->name('update.tuition');
        Route::post('export_tuition', [TuitionController::class, 'export'])->name('export.tuition');
        Route::get('search_tuition', [TuitionController::class, 'search'])->name('search.tuition');
        Route::post('print_tuition', [TuitionController::class, 'print'])->name('print.tuition');
    });

    Route::prefix('fee')->group(function () {
        Route::get('show', [FeeController::class, 'index'])->name('fee');
        Route::post('add_fee', [FeeController::class, 'store'])->name('add.fee');
        Route::post('delete_fee', [FeeController::class, 'destroy'])->name('delete.fee');
        Route::post('update_fee', [FeeController::class, 'update'])->name('update.fee');
        Route::get('search_fee', [FeeController::class, 'search'])->name('search.fee');
    });

});


