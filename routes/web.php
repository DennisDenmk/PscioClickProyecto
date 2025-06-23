<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

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


Route::middleware(['auth', 'rol:administrador'])->get('/admin/dashboard', function () {
    return view('admin.dashboards');
})->name('admin.dashboard');

Route::middleware(['auth', 'rol:doctor'])->get('/doctor/dashboard', function () {
    return view('doctor.dashboards');
})->name('doctor.dashboard');

Route::middleware(['auth', 'rol:secretario'])->get('/secretario/dashboard', function () {
    return view('secretario.dashboards');
})->name('secretario.dashboard');


/* Rutas para gestión de pacientes (secretario) */
Route::middleware(['auth', 'rol:secretario'])->group(function () {
    Route::resource('pacientes', PacienteController::class)->except(['show']);
});

/* Mostrar detalle del paciente (acceso compartido para secretario y doctor) */
Route::middleware(['auth', 'rol:secretario,doctor'])->get('pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');

require __DIR__.'/auth.php';
