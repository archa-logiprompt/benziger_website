<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JournalAuthorController;

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

// Route::post('admin/user/journal', [JournalController::class, 'createJournal'])->name('admin.user.journal');
Route::post('admin/user/journalAuthor', [JournalAuthorController::class, 'createAuthor'])->name('admin.user.journalAuthor');
