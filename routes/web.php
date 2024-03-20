<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
    Route::post('/user/clockInOut', [App\Http\Controllers\EmployeeController::class, 'clockInOut'])->name('user.clockInOut');
    Route::post('/user/clockOut', [App\Http\Controllers\EmployeeController::class, 'clockOut'])->name('user.clockOut');
    Route::post('/user/takeBreak', [App\Http\Controllers\EmployeeController::class, 'takeBreak'])->name('user.takeBreak');
    Route::post('/user/endBreak', [App\Http\Controllers\EmployeeController::class, 'endBreak'])->name('user.endBreak');
});

