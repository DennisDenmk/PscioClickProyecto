<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\CitaController;


Route::get('/', function () {
    return view('home.home');
})->name('home.home');

Route::get('/login', function () {
    return view('auth.login')->name('login');
});
// routes/web.php
Route::get('/acceso-denegado', function () {
    return view('acceso_denegado');
})->name('acceso.denegado');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
//Solo Administrador
Route::middleware(['auth', 'rol:administrador'])->group(function () {
    Route::prefix('administrador')->group(function () {
        Route::get('/dashboard', [AdminController::class,'index']) ->name('admin.dashboard');
        Route::get('/usuarios', [AdminController::class, 'indexUser'])->name('usuarios.index');
        Route::get('/{cedula}/edit', [AdminController::class, 'editUser'])->name('usuarios.edit');
        Route::put('/{cedula}', [AdminController::class, 'updateUser'])->name('usuarios.update');
    });
});
// Solo secretario
Route::middleware(['auth', 'rol:secretario'])->group(function () {
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
    Route::prefix('estado-civil')->group(function () {
        Route::get('/', [PacienteController::class, 'indexEstadoCivil'])->name('estado_civil.index');
        Route::get('/create', [PacienteController::class, 'createEstadoCivil'])->name('estado_civil.create');
        Route::post('/', [PacienteController::class, 'storeEstadoCivil'])->name('estado_civil.store');
        Route::get('/{id}/edit', [PacienteController::class, 'editEstadoCivil'])->name('estado_civil.edit');
        Route::put('/{id}', [PacienteController::class, 'updateEstadoCivil'])->name('estado_civil.update');
    });
    Route::prefix('citas')->group(function () {
        Route::get('/', [CitaController::class, 'indexCita'])->name('citas.index');
        Route::get('/create', [CitaController::class, 'createCita'])->name('citas.create');
        Route::post('/', [CitaController::class, 'storeCita'])->name('citas.store');
        Route::get('/{id}/edit', [CitaController::class, 'editCita'])->name('citas.edit');
        Route::put('/{id}', [CitaController::class, 'updateCita'])->name('citas.update');
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
    //Tipos antecedentes
    Route::prefix('tipo-antecedente')->group(function () {
        Route::get('/', [HistoriaClinicaController::class, 'indexTipoAntecedente'])->name('tipo_antecedente.index');
        Route::get('/create', [HistoriaClinicaController::class, 'createTipoAntecedente'])->name('tipo_antecedente.create');
        Route::post('/', [HistoriaClinicaController::class, 'storeTipoAntecedente'])->name('tipo_antecedente.store');
        Route::get('/{id}/edit', [HistoriaClinicaController::class, 'editTipoAntecedente'])->name('tipo_antecedente.edit');
        Route::put('/{id}', [HistoriaClinicaController::class, 'updateTipoAntecedente'])->name('tipo_antecedente.update');
    });
    //Enfermedad Actual
    Route::prefix('enfermedad-actual')->group(function () {
        Route::get('/{his_id}', [HistoriaClinicaController::class, 'indexEnfermedadActual'])->name('enfermedad_actual.index');
        Route::get('/{his_id}/create', [HistoriaClinicaController::class, 'createEnfermedadActual'])->name('enfermedad_actual.create');
        Route::post('/{his_id}', [HistoriaClinicaController::class, 'storeEnfermedadActual'])->name('enfermedad_actual.store');
        Route::get('/edit/{id}', [HistoriaClinicaController::class, 'editEnfermedadActual'])->name('enfermedad_actual.edit');
        Route::put('/{id}', [HistoriaClinicaController::class, 'updateEnfermedadActual'])->name('enfermedad_actual.update');
    });

    //Tipo de enfermedad
    Route::prefix('tipo-enfermedad')->group(function () {
        Route::get('/', [HistoriaClinicaController::class, 'indexTipoEnfermedadActual'])->name('tipo_enfermedad_actual.index');
        Route::get('/create', [HistoriaClinicaController::class, 'createTipoEnfermedadActual'])->name('tipo_enfermedad_actual.create');
        Route::post('/', [HistoriaClinicaController::class, 'storeTipoEnfermedadActual'])->name('tipo_enfermedad_actual.store');
        Route::get('/{id}/edit', [HistoriaClinicaController::class, 'editTipoEnfermedadActual'])->name('tipo_enfermedad_actual.edit');
        Route::put('/{id}', [HistoriaClinicaController::class, 'updateTipoEnfermedadActual'])->name('tipo_enfermedad_actual.update');
    });
    //Plan de tratamiento
    Route::prefix('plan-tratamiento')
        ->name('plan_tratamiento.')
        ->group(function () {
            Route::get('/{his_id}', [HistoriaClinicaController::class, 'indexPlanTratamiento'])->name('index');
            Route::get('/{his_id}/create', [HistoriaClinicaController::class, 'createPlanTratamiento'])->name('create');
            Route::post('/{his_id}', [HistoriaClinicaController::class, 'storePlanTratamiento'])->name('store');
            Route::get('/{id}/edit', [HistoriaClinicaController::class, 'editPlanTratamiento'])->name('edit');
            Route::put('/{id}', [HistoriaClinicaController::class, 'updatePlanTratamiento'])->name('update');
        });

    Route::prefix('estado-reproductivo')
        ->name('estado_reproductivo.')
        ->group(function () {
            Route::get('/{his_id}', [HistoriaClinicaController::class, 'indexEstadoReproductivo'])->name('index');
            Route::get('/{his_id}/create', [HistoriaClinicaController::class, 'createEstadoReproductivo'])->name('create');
            Route::post('/{his_id}', [HistoriaClinicaController::class, 'storeEstadoReproductivo'])->name('store');
            Route::get('/{id}/edit', [HistoriaClinicaController::class, 'editEstadoReproductivo'])->name('edit');
            Route::put('/{id}', [HistoriaClinicaController::class, 'updateEstadoReproductivo'])->name('update');
        });

    Route::prefix('evaluaciones')->group(function () {
        Route::get('/{his_id}', [HistoriaClinicaController::class, 'indexEvaluacion'])->name('evaluaciones.index');
        Route::get('/{his_id}/create', [HistoriaClinicaController::class, 'createEvaluacion'])->name('evaluaciones.create');
        Route::post('/{his_id}', [HistoriaClinicaController::class, 'storeEvaluacion'])->name('evaluaciones.store');
        Route::get('/edit/{id}', [HistoriaClinicaController::class, 'editEvaluacion'])->name('evaluaciones.edit');
        Route::put('/{id}', [HistoriaClinicaController::class, 'updateEvaluacion'])->name('evaluaciones.update');
    });

    Route::patch('/notificaciones/{id}/leida', function ($id) {
        $notificacion = auth()->user()->notifications()->findOrFail($id);
        $notificacion->markAsRead();
        return back();
    })->name('notificaciones.marcarLeida');
});

// Rutas accesibles por doctor y secretario
Route::middleware(['auth', 'rol:doctor,secretario,administrador'])->group(function () {
    Route::get('/historias/', [HistoriaClinicaController::class, 'index'])->name('historia_clinica.index');
    Route::get('/historias/{his_id}', [HistoriaClinicaController::class, 'show'])->name('historias.show');
    Route::get('/citas/calendario', [CitaController::class, 'mostrarCalendario'])->name('citas.calendario');
    Route::get('/citas/calendario/mostrar/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::get('/citas/calendario/datos', [CitaController::class, 'citasCalendario'])->name('citas.calendario.data');
    Route::get('/pacientes/buscar/{cedula}', [PacienteController::class, 'buscar']);
    Route::get('/citas/por-fecha/{fecha}', [CitaController::class, 'porFecha']);
});



require __DIR__ . '/auth.php';
