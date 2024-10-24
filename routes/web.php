<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/teacher/home', [TeacherController::class, 'index'])->name('teacher.home');
    Route::get('/teacher/student/{id}', [StudentController::class, 'show'])->name('student.show');

    Route::post('/teacher/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/teacher/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::post('/teacher/student/add', [StudentController::class, 'store'])->name('student.add');
});