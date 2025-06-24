<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Models\HistoriaClinica;

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php
Route::get('/acceso-denegado', function () {
    return view('acceso_denegado'); 
})->name('acceso.denegado'); 


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


Route::middleware(['auth', 'rol:secretario'])->group(function () {
    Route::resource('pacientes', PacienteController::class)->except(['show']);
});

Route::middleware(['auth', 'rol:secretario,doctor'])->get('pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');


//HistoriaClinica

Route::middleware(['auth', 'rol:doctor,secretario'])->prefix('historia-clinica')->group(function () {

    // Historias clínicas
    Route::get('/', [HistoriaClinicaController::class, 'index'])->name('historia_clinica.index');
    Route::get('/create', [HistoriaClinicaController::class, 'create'])->name('historia_clinica.create');
    Route::post('/', [HistoriaClinicaController::class, 'store'])->name('historia_clinica.store');

    // Detalles de historias clínicas
    Route::get('{his_id}/detalles/create', [HistoriaClinicaController::class, 'createDetalle'])->name('detalles.create');
    Route::post('{his_id}/detalles', [HistoriaClinicaController::class, 'storeDetalle'])->name('detalles.store');
    Route::get('detalles/{deth_id}/edit', [HistoriaClinicaController::class, 'editDetalle'])->name('detalles.edit');
    Route::put('detalles/{deth_id}', [HistoriaClinicaController::class, 'updateDetalle'])->name('detalles.update');
    Route::delete('detalles/{deth_id}', [HistoriaClinicaController::class, 'destroyDetalle'])->name('detalles.destroy');
    Route::get('/historias/{his_id}', [HistoriaClinicaController::class, 'show'])->name('historias.show');
});



require __DIR__.'/auth.php';
