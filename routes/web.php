<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DiveController;
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

// Routes for sessions
Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
Route::get('/sessions/{session}', [SessionController::class, 'show'])->name('sessions.show');
Route::get('/sessions/{session}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
Route::put('/sessions/{session}', [SessionController::class, 'update'])->name('sessions.update');
Route::delete('/sessions/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');

// Routes for dives
Route::get('/sessions/{session}/dives/create', [DiveController::class, 'create'])->name('dives.create');
Route::post('/sessions/{session}/dives', [DiveController::class, 'store'])->name('dives.store');
Route::get('/sessions/{session}/dives/{dive}', [DiveController::class, 'show'])->name('dives.show');
Route::get('/sessions/{session}/dives/{dive}/edit', [DiveController::class, 'edit'])->name('dives.edit');
Route::put('/sessions/{session}/dives/{dive}', [DiveController::class, 'update'])->name('dives.update');
Route::delete('/sessions/{session}/dives/{dive}', [DiveController::class, 'destroy'])->name('dives.destroy');

require __DIR__.'/auth.php';
