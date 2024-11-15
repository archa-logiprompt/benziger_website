<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\BannerImageController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JournalAuthorController;
use App\Http\Controllers\ResearchareaController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\NotificationsController;

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

    Route::get('staff/journal', [JournalController::class, 'viewAllJournal'])->name('journal.index');
    Route::get('staff/journal/viewById/{id}', [JournalController::class, 'viewJournalById'])->name('journal.view');
    Route::post('staff/journal/reject', [JournalController::class, 'rejectJournel'])->name('journal.reject');
    Route::post('staff/journal/accept', [JournalController::class, 'acceptJournel'])->name('journal.accept');

    Route::get('admin/roles/index', [AdminController::class, 'viewRole'])->name('admin.roles.view');
    Route::get('admin/roles/view', [AdminController::class, 'CreateRoleView'])->name('admin.role.createView');
    Route::post('admin/role/store', [AdminController::class, 'createRole'])->name('admin.role.store');
    Route::get('admin/role/delete/{id}', [AdminController::class, 'deleteRole'])->name('admin.role.delete');
    Route::get('admin/role/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/role/update/{id}', [AdminController::class, 'updateRole'])->name('admin.role.update');
    Route::get('admin/role/assign/{id}', [AdminController::class, 'assign']);
    Route::post('admin/role/assign', [AdminController::class, 'AssignRole'])->name('admin.role.assignrole');

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


    // Notifications crud
    Route::get('admin/notifications', [NotificationsController::class, 'index'])->name('admin.notifications');
    Route::get('admin/notifications/create', [NotificationsController::class, 'create'])->name('admin.notifications.create');
    Route::post('admin/notifications/store', [NotificationsController::class, 'store'])->name('admin.notifications.store');
    Route::get('admin/notifications/delete/{id}', [NotificationsController::class, 'destroy']);
    Route::get('admin/notifications/edit/{id}', [NotificationsController::class, 'edit']);
    Route::post('admin/notifications/update/{id}', [NotificationsController::class, 'update']);

    // banner image crud
    Route::get('admin/bannerImage', [BannerImageController::class, 'index'])->name('admin.bannerImage');
    Route::get('admin/bannerImage/create', [BannerImageController::class, 'create'])->name('admin.bannerImage.create');
    Route::post('admin/bannerImage/store', [BannerImageController::class, 'store'])->name('admin.bannerImage.store');
    Route::get('admin/bannerImage/delete/{id}', [BannerImageController::class, 'destroy']);
    Route::get('admin/bannerImage/edit/{id}', [BannerImageController::class, 'edit']);
    Route::post('admin/bannerImage/update/{id}', [BannerImageController::class, 'update']);
});

Route::get('user/index', [JournalController::class, 'index'])->name('user.index');
Route::post('user/otp/check', [JournalController::class, 'otpCheck'])->name('user.otp');
Route::get('user/resumbit/{id}', [JournalController::class, 'reSubmit'])->name('user.resubmit');
Route::post('user/update', [JournalController::class, 'updateJournal'])->name('user.update');
