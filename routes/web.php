<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('applications')->name('applications.')->group(function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('index');       // Tampilkan semua data
    Route::post('/', [ApplicationController::class, 'store'])->name('store');       // Simpan data baru
    Route::put('/{application}', [ApplicationController::class, 'update'])->name('update'); // Update data
    Route::delete('/{application}', [ApplicationController::class, 'destroy'])->name('destroy'); // Hapus data
});

Route::get('/unit', function () {
    return view('unit');
});

Route::get('/unit/{id}/detail', function ($id) {
    return view('detail');
});


require __DIR__.'/auth.php';
