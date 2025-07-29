<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LokasiPembelianController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== Manual Logout =====
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ===== Authenticated Routes =====
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

    Route::post('/lokasi-pembelian/ajax-store', [LokasiPembelianController::class, 'ajaxStore'])->name('lokasi-pembelian.ajax-store');
        Route::get('/lokasi-pembelian/json', [LokasiPembelianController::class, 'json'])->name('lokasi-pembelian.json');


    // ===== Unit view (custom) =====
    Route::get('/unit', function () {
        return view('unit');
    })->name('unit');

    // ===== Detail Aplikasi (tanpa controller) =====
    Route::get('/unit/{id}/detail', function ($id) {
        return view('detail', ['id' => $id]);
    });

    // ===== Admin-only Routes (superadmin) =====
    Route::middleware('role:superadmin|admin')->group(function () {

        // Lokasi Pembelian
        Route::resource('lokasi_pembelian', LokasiPembelianController::class);

        

        // Users
        Route::resource('users', UserController::class);

        // Roles & Permissions
        Route::resource('roles', RolePermissionController::class);
        Route::post('/permissions/ajax-create', [RolePermissionController::class, 'ajaxStore'])->name('permissions.ajax.store');
        Route::delete('/permissions/{id}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');

        // Units
        Route::resource('units', UnitController::class);
    });
});

// ===== Auth Scaffolding =====
require __DIR__.'/auth.php';
