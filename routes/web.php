<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JournalAuthorController;
use App\Http\Controllers\ResearchareaController;
use App\Http\Controllers\GeneralSettingController;


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
    Route::get('admin/department/delete/{id}', [DepartmentController::class, 'destroy']);
    Route::get('admin/department/edit/{id}', [DepartmentController::class, 'edit']);
    Route::post('admin/department/update/{id}', [DepartmentController::class, 'update']);



    Route::get('admin/staff', [StaffController::class, 'index'])->name('admin.staff');
    Route::get('staff/create', [StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('admin/staff/store', [StaffController::class, 'store'])->name('admin.staff.store');
    Route::get('admin/staff/delete/{id}', [StaffController::class, 'destroy']);
    Route::get('admin/staff/edit/{id}', [StaffController::class, 'edit']);
    Route::post('admin/staff/update/{id}', [StaffController::class, 'update']);


    // adding journal and journal author
    Route::post('admin/user/journal', [JournalController::class, 'create'])->name('admin.user.journal');
    Route::post('admin/user/journalAuthor', [JournalAuthorController::class, 'createAuthor'])->name('admin.user.journal');

    // research area crud
    Route::get('admin/researcharea', [ResearchareaController::class, 'index'])->name('admin.researcharea');
    Route::get('admin/researcharea/create', [ResearchareaController::class, 'create'])->name('admin.researcharea.create');
    Route::post('admin/researcharea/store', [ResearchareaController::class, 'store'])->name('admin.researcharea.store');
    Route::get('admin/researcharea/delete/{id}', [ResearchareaController::class, 'destroy']);
    Route::get('admin/researcharea/edit/{id}', [ResearchareaController::class, 'edit']);
    Route::post('admin/researcharea/update/{id}', [ResearchareaController::class, 'update']);

 // general setting crud
 Route::get('admin/generalsettings', [GeneralSettingController::class, 'index'])->name('admin.generalsettings');
 Route::get('admin/generalsettings/create', [GeneralSettingController::class, 'create'])->name('admin.generalsettings.create');
 Route::post('admin/generalsettings/store', [GeneralSettingController::class, 'store'])->name('admin.generalsettings.store');
 Route::get('admin/generalsettings/delete/{id}', [GeneralSettingController::class, 'destroy']);
 Route::get('admin/generalsettings/edit/{id}', [GeneralSettingController::class, 'edit']);
 Route::post('admin/generalsettings/update/{id}', [GeneralSettingController::class, 'update']);

});
