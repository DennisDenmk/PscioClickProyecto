<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\DetalleHistoria;
use App\Models\SignoVital;
use App\Models\TipoAntecedente;
use App\Models\EnfermedadActual;
use App\Models\TipoEnfermedadActual;
use App\Models\PlanTratamiento;
use App\Models\EstadoReproductivo;
use App\Models\Evaluacion;

use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function create()
    {
        $pacientes = Paciente::all(); // para el select
        return view('historia_clinica.create', compact('pacientes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'pac_id' => 'required|exists:pacientes,pac_cedula',
        ]);

        // Verificar si ya existe una historia clínica con esa cédula
        $existe = HistoriaClinica::where('pac_id', $request->pac_id)->exists();

        if ($existe) {
            return redirect()
                ->back()
                ->withErrors(['pac_id' => 'Ya existe una historia clínica para este paciente.'])
                ->withInput();
        }

        // Crear la historia clínica si no existe
        HistoriaClinica::create([
            'pac_id' => $request->pac_id,
        ]);

        return redirect()->route('historia_clinica.create')->with('success', 'Historia clínica creada.');
    }

    public function index(Request $request)
    {
        $cedula = $request->input('cedula');

        $historias = HistoriaClinica::with('paciente')
            ->when($cedula, function ($query, $cedula) {
                $query->whereHas('paciente', function ($q) use ($cedula) {
                    $q->where('pac_cedula', 'like', "%$cedula%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('historia_clinica.index', compact('historias', 'cedula'));
    }
    public function home($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'detallesHistoria'])->findOrFail($his_id);
        return view('historia_clinica.home', compact('historia'));
    }

    public function createDetalle($his_id)
    {
        return view('historia_clinica.createDetalle', compact('his_id'));
    }

    public function storeDetalle(Request $request, $his_id)
    {
        $validated = $request->validate([
            'deth_fecha_valoracion' => 'required|date',
            'deth_hora' => 'required',
            'deth_motivo_consulta' => 'required|string',
            'deth_tratamientos_previos' => 'nullable|string',
            'deth_peso' => 'required|numeric',
            'deth_talla' => 'required|numeric',
            'deth_imc' => 'required|numeric',
            'deth_lado_dolor' => 'nullable|string',
            'deth_exploracion_fisica' => 'nullable|string',
        ]);

        $validated['his_id'] = $his_id;

        DetalleHistoria::create($validated);

        return redirect()->route('historia_clinica.home', $his_id)->with('success', 'Consulta registrada.');
    }

    public function editDetalle($deth_id)
    {
        $detalle = DetalleHistoria::findOrFail($deth_id);
        return view('historia_clinica.editDetalle', compact('detalle'));
    }

    public function updateDetalle(Request $request, $deth_id)
    {
        $detalle = DetalleHistoria::findOrFail($deth_id);

        $validated = $request->validate([
            'deth_fecha_valoracion' => 'required|date',
            'deth_hora' => 'required',
            'deth_motivo_consulta' => 'required|string',
            'deth_tratamientos_previos' => 'nullable|string',
            'deth_peso' => 'required|numeric',
            'deth_talla' => 'required|numeric',
            'deth_imc' => 'required|numeric',
            'deth_lado_dolor' => 'nullable|string',
            'deth_exploracion_fisica' => 'nullable|string',
        ]);

        $detalle->update($validated);

        return redirect()->route('historia_clinica.index')->with('success', 'Detalle actualizado.');
    }

    public function showDetalle($his_id)
    {
        $historia = HistoriaClinica::with('paciente')->findOrFail($his_id);

        $detalles = DetalleHistoria::where('his_id', $his_id)->orderBy('deth_fecha_valoracion', 'desc')->orderBy('deth_hora', 'desc')->paginate(10);

        return view('historia_clinica.showDetalle', compact('historia', 'detalles'));
    }

    public function destroyDetalle($deth_id)
    {
        DetalleHistoria::destroy($deth_id);

        return redirect()->back()->with('success', 'Detalle eliminado.');
    }
    public function crearSignoVital($his_id)
    {
        return view('historia_clinica.signos.create', compact('his_id'));
    }

    public function guardarSignoVital(Request $request, $his_id)
    {
        $request->validate([
            'sig_tension_arterial_sistolica' => 'required|integer|min:0',
            'sig_tension_arterial_diastolica' => 'required|integer|min:0',
            'sig_frecuencia_cardiaca' => 'required|integer|min:0',
            'sig_frecuencia_respiratoria' => 'required|integer|min:0',
            'sig_saturacion_oxigeno' => 'required|integer|min:0',
            'sig_temperatura' => 'required|numeric|min:0',
        ]);

        SignoVital::create(array_merge($request->all(), ['sig_his_id' => $his_id]));

        return redirect()->route('historias.show', $his_id)->with('success', 'Signos vitales guardados.');
    }

    public function editarSignoVital($id)
    {
        $signo = SignoVital::findOrFail($id);
        return view('historia_clinica.signos.edit', compact('signo'));
    }

    public function actualizarSignoVital(Request $request, $id)
    {
        $signo = SignoVital::findOrFail($id);

        $request->validate([
            'sig_tension_arterial_sistolica' => 'required|integer|min:0',
            'sig_tension_arterial_diastolica' => 'required|integer|min:0',
            'sig_frecuencia_cardiaca' => 'required|integer|min:0',
            'sig_frecuencia_respiratoria' => 'required|integer|min:0',
            'sig_saturacion_oxigeno' => 'required|integer|min:0',
            'sig_temperatura' => 'required|numeric|min:0',
        ]);

        $signo->update($request->all());

        return redirect()->route('historias.show', $signo->sig_his_id)->with('success', 'Signos vitales actualizados.');
    }

    public function eliminarSignoVital($id)
    {
        $signo = SignoVital::findOrFail($id);
        $his_id = $signo->sig_his_id;
        $signo->delete();

        return redirect()->route('historia_clinica.show', $his_id)->with('success', 'Signos vitales eliminados.');
    }
    //Habito
    public function createHabito($his_id)
    {
        $tiposHabitos = \App\Models\TipoHabito::all();
        return view('historia_clinica.habitos.create', compact('his_id', 'tiposHabitos'));
    }
    public function storeHabito(Request $request, $his_id)
    {
        $request->validate([
            'habitos' => 'required|array|min:1',
            'habitos.*.tipo_hab_id' => 'required|exists:tipo_habito,tipo_hab_id',
            'habitos.*.hab_detalle' => 'nullable|string',
        ]);

        foreach ($request->habitos as $habito) {
            \App\Models\Habito::create([
                'hab_his_id' => $his_id,
                'tipo_hab_id' => $habito['tipo_hab_id'],
                'hab_detalle' => $habito['hab_detalle'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Hábitos registrados correctamente.');
    }

    public function showHabitos($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'habitos.tipoHabito'])->findOrFail($his_id);

        return view('historia_clinica.habitos.show', compact('historia'));
    }
    public function createAntecedente($his_id)
    {
        $tiposAntecedentes = TipoAntecedente::all();
        return view('historia_clinica.antecedentes.create', compact('his_id', 'tiposAntecedentes'));
    }

    public function storeAntecedente(Request $request, $his_id)
    {
        $request->validate([
            'antecedentes' => 'required|array|min:1',
            'antecedentes.*.tipo_ant_id' => 'required|exists:tipo_antecedente,tipa_id',
            'antecedentes.*.ant_detalle' => 'nullable|string',
        ]);

        foreach ($request->antecedentes as $ant) {
            \App\Models\Antecedente::create([
                'ant_his_id' => $his_id,
                'tipo_ant_id' => $ant['tipo_ant_id'],
                'ant_detalle' => $ant['ant_detalle'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Antecedentes registrados correctamente.');
    }

    public function showAntecedente($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'detallesHistoria', 'signosVitales', 'habitos.tipoHabito', 'antecedentes.tipoAntecedente'])->findOrFail($his_id);

        return view('historia_clinica.antecedentes.show', compact('historia'));
    }
    public function indexTipoAntecedente()
    {
        $tipos = TipoAntecedente::all();
        return view('historia_clinica.tipoantecedentes.index', compact('tipos'));
    }

    public function createTipoAntecedente()
    {
        return view('historia_clinica.tipoantecedentes.create');
    }

    public function storeTipoAntecedente(Request $request)
    {
        $request->validate([
            'tipa_nombre' => 'required|string|max:100|unique:tipo_antecedente,tipa_nombre',
        ]);

        TipoAntecedente::create($request->only('tipa_nombre'));

        return redirect()->route('tipo_antecedente.index')->with('success', 'Tipo de antecedente creado correctamente.');
    }

    public function editTipoAntecedente($id)
    {
        $tipo = TipoAntecedente::findOrFail($id);
        return view('historia_clinica.tipoantecedentes.edit', compact('tipo'));
    }

    public function updateTipoAntecedente(Request $request, $id)
    {
        $request->validate([
            'tipa_nombre' => 'required|string|max:100|unique:tipo_antecedente,tipa_nombre,' . $id . ',tipa_id',
        ]);

        $tipo = TipoAntecedente::findOrFail($id);
        $tipo->update($request->only('tipa_nombre'));

        return redirect()->route('tipo_antecedente.index')->with('success', 'Tipo de antecedente actualizado correctamente.');
    }
    public function indexEnfermedadActual($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'detallesHistoria', 'signosVitales', 'habitos.tipoHabito', 'antecedentes.tipoAntecedente', 'enfermedadesActuales.tipoEnfermedad'])->findOrFail($his_id);
        return view('historia_clinica.enfermedad_actual.index', compact('historia'));
    }

    public function createEnfermedadActual()
    {
        $tipos = TipoEnfermedadActual::all();
        return view('historia_clinica.enfermedad_actual.create', compact('tipos'));
    }

    public function storeEnfermedadActual(Request $request, $his_id)
    {
        $request->validate([
            'enfermedades' => 'required|array|min:1',
            'enfermedades.*.enf_tipo_id' => 'required|exists:tipo_enfermedad_actual,tipo_enf_id',
            'enfermedades.*.enf_descripcion' => 'required|string',
        ]);

        foreach ($request->enfermedades as $enf) {
            EnfermedadActual::create([
                'enf_his_id' => $his_id,
                'enf_tipo_id' => $enf['enf_tipo_id'],
                'enf_descripcion' => $enf['enf_descripcion'],
            ]);
        }

        return redirect()->back()->with('success', 'Enfermedades actuales registradas correctamente.');
    }

    public function editEnfermedadActual($id)
    {
        $enfermedad = EnfermedadActual::findOrFail($id);
        $tipos = TipoEnfermedadActual::all();

        return view('historia_clinica.enfermedad_actual.edit', compact('enfermedad', 'tipos'));
    }

    public function updateEnfermedadActual(Request $request, $id)
    {
        $request->validate([
            'enf_tipo_id' => 'required|exists:tipo_enfermedad_actual,tipo_enf_id',
            'enf_descripcion' => 'required|string|max:255',
        ]);

        $enfermedad = EnfermedadActual::findOrFail($id);
        $enfermedad->update($request->only('enf_tipo_id', 'enf_descripcion'));

        return redirect()->route('enfermedad_actual.index')->with('success', 'Registro actualizado.');
    }
    //Tipo de enfermadad actual
    public function indexTipoEnfermedadActual()
    {
        $tipos = TipoEnfermedadActual::all();
        return view('historia_clinica.tipo_enfermedad_actual.index', compact('tipos'));
    }

    public function createTipoEnfermedadActual()
    {
        return view('historia_clinica.tipo_enfermedad_actual.create');
    }

    public function storeTipoEnfermedadActual(Request $request)
    {
        $request->validate([
            'tipo_enf_nombre' => 'required|string|max:100|unique:tipo_enfermedad_actual,tipo_enf_nombre',
        ]);

        TipoEnfermedadActual::create($request->only('tipo_enf_nombre'));

        return redirect()->route('tipo_enfermedad_actual.index')->with('success', 'Tipo creado correctamente.');
    }

    public function editTipoEnfermedadActual($id)
    {
        $tipo = TipoEnfermedadActual::findOrFail($id);
        return view('historia_clinica.tipo_enfermedad_actual.edit', compact('tipo'));
    }

    public function updateTipoEnfermedadActual(Request $request, $id)
    {
        $request->validate([
            'tipo_enf_nombre' => 'required|string|max:100|unique:tipo_enfermedad_actual,tipo_enf_nombre,' . $id . ',tipo_enf_id',
        ]);

        $tipo = TipoEnfermedadActual::findOrFail($id);
        $tipo->update($request->only('tipo_enf_nombre'));

        return redirect()->route('tipo_enfermedad_actual.index')->with('success', 'Tipo actualizado correctamente.');
    }
    public function indexPlanTratamiento($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'planesTratamiento'])->findOrFail($his_id);
        $planes = $historia->planesTratamiento;
        return view('historia_clinica.plan_tratamiento.index', compact('historia', 'planes'));
    }

    public function createPlanTratamiento($his_id)
    {
        $historia = HistoriaClinica::with('paciente')->findOrFail($his_id);

        return view('historia_clinica.plan_tratamiento.create', compact('historia'));
    }

    public function storePlanTratamiento(Request $request, $his_id)
    {
        $request->validate([
            'pla_diagnostico' => 'required|string',
            'pla_objetivo_tratamiento' => 'required|string',
            'pla_tratamiento' => 'required|string',
        ]);

        PlanTratamiento::create([
            'pla_his_id' => $his_id,
            'pla_diagnostico' => $request->pla_diagnostico,
            'pla_objetivo_tratamiento' => $request->pla_objetivo_tratamiento,
            'pla_tratamiento' => $request->pla_tratamiento,
        ]);

        return redirect()->back()->with('success', 'Plan de tratamiento registrado correctamente.');
    }

    public function editPlanTratamiento($id)
    {
        $plan = PlanTratamiento::findOrFail($id);
        $historias = HistoriaClinica::all();
        return view('historia_clinica.plan_tratamiento.edit', compact('plan', 'historias'));
    }

    public function updatePlanTratamiento(Request $request, $id)
    {
        $request->validate([
            'pla_diagnostico' => 'required|string|max:255',
            'pla_objetivo_tratamiento' => 'required|string|max:255',
            'pla_tratamiento' => 'required|string|max:255',
        ]);

        $plan = PlanTratamiento::findOrFail($id);
        $plan->update($request->all());

        return redirect()->route('plan_tratamiento.index', $plan->pla_his_id)->with('success', 'Plan actualizado correctamente.');
    }
    //Estado  reproductivo
    public function indexEstadoReproductivo($his_id)
    {
        $estados = EstadoReproductivo::where('est_his_id', $his_id)->get();
        return view('historia_clinica.estado_reproductivo.index', compact('estados', 'his_id'));
    }

    public function createEstadoReproductivo($his_id)
    {
        $historia = HistoriaClinica::with('paciente')->findOrFail($his_id);
        return view('historia_clinica.estado_reproductivo.create', compact('historia'));
    }

    public function storeEstadoReproductivo(Request $request, $his_id)
    {
        $request->validate([
            'est_esta_embarazada' => 'required|boolean',
            'est_cantidad_hijos' => 'required|integer|min:0',
        ]);

        EstadoReproductivo::create([
            'est_his_id' => $his_id,
            'est_esta_embarazada' => $request->est_esta_embarazada,
            'est_cantidad_hijos' => $request->est_cantidad_hijos,
        ]);

        return redirect()->route('estado_reproductivo.index', $his_id)->with('success', 'Estado reproductivo registrado correctamente.');
    }

    public function editEstadoReproductivo($id)
    {
        $estado = EstadoReproductivo::with('historiaClinica.paciente')->findOrFail($id);
        return view('historia_clinica.estado_reproductivo.edit', compact('estado'));
    }

    public function updateEstadoReproductivo(Request $request, $id)
    {
        $request->validate([
            'est_esta_embarazada' => 'required|boolean',
            'est_cantidad_hijos' => 'required|integer|min:0',
        ]);

        $estado = EstadoReproductivo::findOrFail($id);
        $estado->update($request->only('est_esta_embarazada', 'est_cantidad_hijos'));

        return redirect()->route('estado_reproductivo.index', $estado->est_his_id)->with('success', 'Estado reproductivo actualizado correctamente.');
    }

    public function indexEvaluacion($his_id)
    {
        $evaluaciones = Evaluacion::where('eva_his_id', $his_id)->get();
        return view('historia_clinica.evaluaciones.index', compact('evaluaciones', 'his_id'));
    }

    // Mostrar formulario para crear nueva evaluación
    public function createEvaluacion($his_id)
    {
        return view('historia_clinica.evaluaciones.create', compact('his_id'));
    }

    // Guardar evaluación
    public function storeEvaluacion(Request $request, $his_id)
    {
        $request->validate([
            'eva_evaluacion_dolor' => 'required|string',
            'eva_escala_dolor' => 'required|numeric|min:0|max:10',
            'eva_examenes_complementarios' => 'nullable|string',
        ]);

        Evaluacion::create([
            'eva_his_id' => $his_id,
            'eva_evaluacion_dolor' => $request->eva_evaluacion_dolor,
            'eva_escala_dolor' => $request->eva_escala_dolor,
            'eva_examenes_complementarios' => $request->eva_examenes_complementarios,
        ]);

        return redirect()->route('evaluaciones.index', $his_id)->with('success', 'Evaluación creada correctamente.');
    }

    // Mostrar formulario para editar evaluación
    public function editEvaluacion($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        return view('historia_clinica.evaluaciones.edit', compact('evaluacion'));
    }

    // Actualizar evaluación
    public function updateEvaluacion(Request $request, $id)
    {
        $evaluacion = Evaluacion::findOrFail($id);

        $request->validate([
            'eva_evaluacion_dolor' => 'required|string',
            'eva_escala_dolor' => 'required|numeric|min:0|max:10',
            'eva_examenes_complementarios' => 'nullable|string',
        ]);

        $evaluacion->update([
            'eva_evaluacion_dolor' => $request->eva_evaluacion_dolor,
            'eva_escala_dolor' => $request->eva_escala_dolor,
            'eva_examenes_complementarios' => $request->eva_examenes_complementarios,
        ]);

        return redirect()->route('evaluaciones.index', $evaluacion->eva_his_id)->with('success', 'Evaluación actualizada correctamente.');
    }
}
