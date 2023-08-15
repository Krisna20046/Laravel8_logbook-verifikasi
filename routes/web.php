<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::resource('logbook', LogbookController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::get('/logbook/monitor', [LogbookController::class, 'monitor'])->name('logbook.monitor');
        Route::post('/logbook/{logbook}/approve', [LogbookController::class, 'approve'])->name('logbook.approve');
        Route::post('/logbook/{logbook}/reject', [LogbookController::class, 'reject'])->name('logbook.reject');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::resource('users', UserController::class);
    });

});

// Route::middleware(['admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//     Route::post('/users', [UserController::class, 'store'])->name('users.store');
//     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     Route::resource('users', UserController::class);
//     // Tambahkan route lainnya untuk mengelola pengguna
// });

// Route::group(['middleware' => 'role:Admin', 'prefix' => 'admin'], function () {
//     Route::resource('users', UserController::class);
// });