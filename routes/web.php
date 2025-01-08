<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

// auth routes 
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginCheck'])->name('login.check');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');


// student/user route
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [MainController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/std-attendance', [MainController::class, 'attendanceStore'])->name('std.attendance.store');

    Route::get('/all-leave', [MainController::class, 'leave'])->name('std.leave.index');
    Route::get('/student/leave/create', [MainController::class, 'leaveCreate'])->name('std.leave.create');
    Route::post('/student/leave', [MainController::class, 'leaveStore'])->name('std.leave.store');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin routes
Route::middleware(['auth', IsAdminMiddleware::class])->prefix('admin')->group(function () {

    Route::get('/', [MainController::class, 'adminHome'])->name('admin.home');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students/search/dates', [StudentController::class, 'allStudentsSearch'])->name('students.search.all');
    Route::post('/student/{id}/search/dates', [StudentController::class, 'StudentSearch'])->name('student.search');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.view');
    Route::get('/students/pdf/{id}', [StudentController::class, 'generateStdPdf'])->name('student.pdf');
    Route::get('/all-students/pdf/', [StudentController::class, 'generateAllStdPdf'])->name('students.pdf');

    Route::resource('/leave', LeaveController::class)->except(['show', 'create', 'store']);
    Route::resource('/attendance', AttendanceController::class)->except('show');
});
