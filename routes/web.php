<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\CitaController;
use Monolog\Registry;

Route::get('/', function () {
    return view('auth.login');
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
});
//Solo Administrador
Route::middleware(['auth', 'rol:administrador']) -> group(function(){
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboards');
    })->name('admin.dashboard');
    
    Route::prefix('administrador')->group(function () {
    Route::get('/', [AdminController::class, 'indexUser'])->name('usuarios.index');
    Route::get('/{cedula}/edit', [AdminController::class, 'editUser'])->name('usuarios.edit');
    Route::put('/{cedula}', [AdminController::class, 'updateUser'])->name('usuarios.update');
});

});
   





// Rutas accesibles por doctor y secretario
Route::middleware(['auth', 'rol:doctor,secretario'])->group(function () {
    Route::get('/', [HistoriaClinicaController::class, 'index'])->name('historia_clinica.index');
    Route::get('/historias/{his_id}', [HistoriaClinicaController::class, 'show'])->name('historias.show');
});

// Solo secretario
Route::middleware(['auth', 'rol:secretario'])->group(function () {
    
    Route::get('/secretario/dashboard', function () {
        return view('secretario.dashboards');
    })->name('secretario.dashboard');
    Route::get('/secretario/dashboard', function () {
        return view('secretario.dashboards');
    })->name('secretario.dashboard');
    
    Route::resource('pacientes', PacienteController::class);

    //Tipo cita
    Route::get('/tipos-citas/create', [CitaController::class, 'createTipoCita'])->name('tipocita.create');
    Route::post('/tipos-citas', [CitaController::class, 'storeTipoCita'])->name('tipocita.store');
    Route::get('/tipos-citas', [CitaController::class, 'indexTipoCita'])->name('tipocita.index');
    Route::get('/tipos-citas/{id}/edit', [CitaController::class, 'editTipoCita'])->name('tipocita.edit');
    Route::put('/tipos-citas/{id}', [CitaController::class, 'updateTipoCita'])->name('tipocita.update');
    
    //Promociones
    Route::get('promociones/', [CitaController::class, 'indexPromocion'])->name('promociones.index');
    Route::get('promociones/create', [CitaController::class, 'createPromocion'])->name('promociones.create');
    Route::post('promociones/', [CitaController::class, 'storePromocion'])->name('promociones.store');
    Route::get('promociones/{id}/edit', [CitaController::class, 'editPromocion'])->name('promociones.edit');
    Route::put('promociones/{id}', [CitaController::class, 'updatePromocion'])->name('promociones.update');

    Route::prefix('promocion-cita')->group(function () {
    Route::get('/', [CitaController::class, 'indexPromocionCita'])->name('promocioncita.index');
    Route::get('/create', [CitaController::class, 'createPromocionCita'])->name('promocioncita.create');
    Route::post('/', [CitaController::class, 'storePromocionCita'])->name('promocioncita.store');
    Route::get('/{id}/edit', [CitaController::class, 'editPromocionCita'])->name('promocioncita.edit');
    Route::put('/{id}', [CitaController::class, 'updatePromocionCita'])->name('promocioncita.update');
});
});

// Solo doctor
Route::middleware(['auth', 'rol:doctor'])->group(function () {

    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboards');
    })->name('doctor.dashboard');

    // Crear historia clínica
    Route::get('/create', [HistoriaClinicaController::class, 'create'])->name('historia_clinica.create');
    Route::post('/', [HistoriaClinicaController::class, 'store'])->name('historia_clinica.store');

    // Detalles de historia clinica
    Route::get('{his_id}/detalles/create', [HistoriaClinicaController::class, 'createDetalle'])->name('detalles.create');
    Route::post('{his_id}/detalles', [HistoriaClinicaController::class, 'storeDetalle'])->name('detalles.store');
    Route::get('detalles/{deth_id}/edit', [HistoriaClinicaController::class, 'editDetalle'])->name('detalles.edit');
    Route::put('detalles/{deth_id}', [HistoriaClinicaController::class, 'updateDetalle'])->name('detalles.update');
    Route::delete('detalles/{deth_id}', [HistoriaClinicaController::class, 'destroyDetalle'])->name('detalles.destroy');

    // Signos vitales
    Route::get('{his_id}/signos/create', [HistoriaClinicaController::class, 'crearSignoVital'])->name('signos.create');
    Route::post('{his_id}/signos', [HistoriaClinicaController::class, 'guardarSignoVital'])->name('signos.store');
    Route::get('signos/{id}/edit', [HistoriaClinicaController::class, 'editarSignoVital'])->name('signos.edit');
    Route::put('signos/{id}', [HistoriaClinicaController::class, 'actualizarSignoVital'])->name('signos.update');
    Route::get('signos/{id}', [HistoriaClinicaController::class, 'mostrarSignoVital'])->name('signos.show');

    // Hábitos
    Route::get('{his_id}/habitos/create', [HistoriaClinicaController::class, 'createHabito'])->name('habitos.create');
    Route::post('{his_id}/habitos', [HistoriaClinicaController::class, 'storeHabito'])->name('habitos.store');
    Route::get('/historia-clinica/{his_id}/habitos/show', [HistoriaClinicaController::class, 'showHabitos'])->name('habitos.show');

    // Antecedentes
    Route::get('/{his_id}/antecedentes/create', [HistoriaClinicaController::class, 'createAntecedente'])->name('antecedentes.create');
    Route::post('/{his_id}/antecedentes', [HistoriaClinicaController::class, 'storeAntecedente'])->name('antecedentes.store');
    Route::get('/historia-clinica/{his_id}/antecedentes/show', [HistoriaClinicaController::class, 'showAntecedente'])->name('antecedentes.show');
});

require __DIR__ . '/auth.php';
