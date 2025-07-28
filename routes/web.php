<?php

use App\Http\Controllers\LokasiPembelianController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
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


    Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::resource('roles', RolePermissionController::class)->middleware('auth');
Route::post('/permissions/ajax-create', [App\Http\Controllers\RolePermissionController::class, 'ajaxStore'])->name('permissions.ajax.store');
Route::delete('/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');

Route::middleware(['auth'])->group(function () {
    Route::resource('units', UnitController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('lokasi_pembelian', LokasiPembelianController::class);
});


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
