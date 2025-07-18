<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/photo/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');

    // Applications
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index'); // list semua
        Route::post('/', [ApplicationController::class, 'store'])->name('store'); // tambah
        Route::get('/{application}', [ApplicationController::class, 'show'])->name('show'); // detail
        Route::put('/{application}', [ApplicationController::class, 'update'])->name('update'); // update
        Route::delete('/{application}', [ApplicationController::class, 'destroy'])->name('destroy'); // hapus
    });

    Route::view('/managemen-pengguna/role', 'managemen-pengguna.role.index')->name('role.index');
    Route::view('/managemen-pengguna/role/create', 'managemen-pengguna.role.create')->name('role.create');
    Route::view('/managemen-pengguna/role/edit', 'managemen-pengguna.role.edit')->name('role.edit');


    Route::view('/managemen-pengguna/user', 'managemen-pengguna.user.index')->name('user.index');
    Route::view('/managemen-pengguna/user/create', 'managemen-pengguna.user.create')->name('user.create');
    Route::view('/managemen-pengguna/user/edit', 'managemen-pengguna.user.edit')->name('user.edit');


    // Unit (khusus tampilan unit)
    Route::get('/unit', function () {
        return view('unit');
    })->name('unit');

    // Detail aplikasi (tidak perlu ini kalau sudah ada show di atas)
    Route::get('/unit/{id}/detail', function ($id) {
         return view('detail');
     });
});

require __DIR__.'/auth.php';
