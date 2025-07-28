<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LokasiPembelianController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Tambahkan route logout manual (untuk menyelesaikan error "Route [logout] not defined")
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {

    // ===== Profile =====
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/photo/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');

    // ===== Applications =====
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::post('/', [ApplicationController::class, 'store'])->name('store');
        Route::get('/{application}', [ApplicationController::class, 'show'])->name('show');
        Route::put('/{application}', [ApplicationController::class, 'update'])->name('update');
        Route::delete('/{application}', [ApplicationController::class, 'destroy'])->name('destroy');
    });

    // ===== Users (superadmin only) =====
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // ===== Roles & Permissions (superadmin only) =====
Route::middleware('role:superadmin')->group(function () {
    Route::resource('roles', RolePermissionController::class);
    Route::post('/permissions/ajax-create', [RolePermissionController::class, 'ajaxStore'])->name('permissions.ajax.store');
    Route::delete('/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');

    // ===== Units =====
    Route::resource('units', UnitController::class);
});



    // Unit view (custom)

Route::middleware(['auth'])->group(function () {
    Route::resource('lokasi_pembelian', LokasiPembelianController::class);
});


    // Unit (khusus tampilan unit)

    Route::get('/unit', function () {
        return view('unit');
    })->name('unit');

    // Detail aplikasi tampilan khusus (jika tidak pakai controller)
    Route::get('/unit/{id}/detail', function ($id) {
        return view('detail', ['id' => $id]);
    });
});

// Autentikasi default Laravel (pastikan file ini ada dan berisi route login/register)
require __DIR__.'/auth.php';
