<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
