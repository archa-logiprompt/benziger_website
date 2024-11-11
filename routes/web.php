<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DepartmentController;

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

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/check-login', [AdminController::class, 'check'])->name('check.login');
Route::get('/', function () {
    return view('welcome');
});
Route::middleware([AdminMiddleware::class])->group(function () {

    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
  

    //ddepartment
    Route::get('department', [DepartmentController::class, 'index'])->name('department');
    Route::get('admin/department/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    Route::post('admin/department/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::get('admin/department/delete/{id}', [DepartmentController::class,'destroy']);
    Route::get('admin/department/edit/{id}', [DepartmentController::class,'edit']);
    Route::post('admin/department/update/{id}', [DepartmentController::class,'update']);




    Route::get('admin/staff',[StaffController::class,'index'])->name('admin.staff');
    Route::get('staff/create',[StaffController::class,'create'])->name('admin.staff.create');
    Route::post('admin/staff/store',[StaffController::class,'store'])->name('admin.staff.store');
    Route::get('admin/staff/delete/{id}', [StaffController::class,'destroy']);
    Route::get('admin/staff/edit/{id}',[StaffController::class,'edit']);
    Route::post('admin/staff/update/{id}', [StaffController::class,'update']);
    
});
