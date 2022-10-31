<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\BatchController;
use App\Http\Controllers\backend\StudentController;

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
    return to_route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    //*ADDING BATCHES
    Route::prefix('/batch')->name('batch.')->group(function () {
        Route::GET('/manage', [BatchController::class, 'index'])->name('add');
        Route::GET('/view/{batch:slug}', [BatchController::class, 'view'])->name('view');
        Route::POST('/store', [BatchController::class, 'store'])->name('store');
        Route::GET('/edit/{editedBatch:slug}', [BatchController::class, 'batchEdit'])->name('edit');
        Route::PUT('/update/{editedBatch:slug}', [BatchController::class, 'update'])->name('update');
    });

    //*ADDING STUDENTS TO BATCH
    Route::prefix('/student')->name('student.')->group(function () {
        Route::GET('/add', [StudentController::class, 'index'])->name('add');
        Route::POST('/store', [StudentController::class, 'store'])->name('store');
        Route::GET('/get-fine/{id}', [StudentController::class, 'getFine'])->name('get.fine');
        Route::PUT('/update-fine/{id}', [StudentController::class, 'updateFine'])->name('update.fine');
    });
});
