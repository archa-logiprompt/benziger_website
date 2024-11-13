<?php

use App\Http\Controllers\GeneralSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JournalAuthorController;
use App\Http\Controllers\ResearchareaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/researcharea', [ResearchareaController::class, 'create'])->name('admin.researcharea.create');
Route::get('admin/researcharea/view', [ResearchareaController::class, 'view'])->name('researcharea');
Route::get('admin/researcharea/delete/{id}', [ResearchareaController::class, 'destroy'])->name('admin.researcharea.delete');
Route::get('admin/researcharea/edit/{id}', [ResearchareaController::class, 'edit'])->name('admin.researcharea.edit');
Route::post('admin/researcharea/update/{id}', [ResearchareaController::class, 'update'])->name('researcharea');


Route::get('admin/generalsettings', [GeneralSettingController::class, 'index'])->name('admin.generalsettings');
 Route::get('admin/generalsettings/create', [GeneralSettingController::class, 'create'])->name('admin.generalsettings.create');
 Route::post('admin/generalsettings/store', [GeneralSettingController::class, 'store'])->name('admin.generalsettings.store');
 Route::get('admin/generalsettings/delete/{id}', [GeneralSettingController::class, 'destroy']);
 Route::get('admin/generalsettings/edit/{id}', [GeneralSettingController::class, 'edit']);
 Route::post('admin/generalsettings/update/{id}', [GeneralSettingController::class, 'update']);