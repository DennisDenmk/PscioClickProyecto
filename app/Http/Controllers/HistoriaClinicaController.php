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

        $historia = HistoriaClinica::create([
            'pac_id' => $request->pac_id,
        ]);

        return redirect()->route('historia_clinica.create')->with('success', 'Historia clínica creada.');
    }
    public function index()
    {
        $historias = HistoriaClinica::with('paciente')->latest()->get();
        return view('historia_clinica.index', compact('historias'));
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

        return redirect()->route('historia_clinica.index')->with('success', 'Detalle registrado.');
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
    public function show($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'detallesHistoria'])->findOrFail($his_id);

        return view('historia_clinica.showDetalle', compact('historia'));
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
            'tipo_hab_id' => 'required|exists:tipo_habito,tipo_hab_id',
        ]);

        \App\Models\Habito::create([
            'hab_his_id' => $his_id,
            'tipo_hab_id' => $request->tipo_hab_id,
        ]);

        return redirect()->route('historias.show', $his_id)->with('success', 'Hábito registrado correctamente.');
    }
    public function showHabitos($his_id)
    {
        $historia = HistoriaClinica::with(['paciente', 'habitos.tipoHabito'])->findOrFail($his_id);

        return view('historia_clinica.habitos.show', compact('historia'));
    }
    public function createAntecedente($his_id)
    {
        $tiposAntecedentes = \App\Models\TipoAntecedente::all();
        return view('historia_clinica.antecedentes.create', compact('his_id', 'tiposAntecedentes'));
    }

    public function storeAntecedente(Request $request, $his_id)
    {
        $antecedentes = $request->input('antecedentes');
        $valor = $request->ant_valor === 'Sí' ? true : false;
        foreach ($antecedentes as $tipo_ant_id => $data) {
            if (!isset($data['ant_valor'])) {
                continue;
            }

            \App\Models\Antecedente::create([
                'ant_his_id' => $his_id,
                'tipo_ant_id' => $tipo_ant_id,
                'ant_valor' => $valor,
                'ant_detalle' => $data['ant_detalle'] ?? null,
            ]);
        }

        return redirect()->route('historias.show', $his_id)->with('success', 'Antecedentes guardados.');
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
    public function indexEnfermedadActual()
    {
        $enfermedades = EnfermedadActual::with('tipoEnfermedad', 'historiaClinica')->get();
        return view('historia_clinica.enfermedad_actual.index', compact('enfermedades'));
    }

    public function createEnfermedadActual()
    {
        $tipos = TipoEnfermedadActual::all();
        return view('historia_clinica.enfermedad_actual.create', compact('tipos'));
    }

    public function storeEnfermedadActual(Request $request)
    {
        $request->validate([
            'enf_his_id' => 'required|exists:historia_clinica,his_id',
            'enf_tipo_id' => 'required|exists:tipo_enfermedad_actual,tipo_enf_id',
            'enf_descripcion' => 'required|string|max:255',
        ]);

        EnfermedadActual::create($request->only('enf_his_id', 'enf_tipo_id', 'enf_descripcion'));

        return redirect()->route('enfermedad_actual.index')->with('success', 'Enfermedad actual registrada.');
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
    public function indexPlanTratamiento()
    {
        $planes = PlanTratamiento::with('historiaClinica')->get();
        return view('historia_clinica.plan_tratamiento.index', compact('planes'));
    }

    public function createPlanTratamiento()
    {
        $historias = HistoriaClinica::all();
        return view('historia_clinica.plan_tratamiento.create', compact('historias'));
    }

    public function storePlanTratamiento(Request $request)
    {
        $request->validate([
            'pla_his_id' => 'required|exists:historia_clinica,his_id',
            'pla_diagnostico' => 'required|string|max:255',
            'pla_objetivo_tratamiento' => 'required|string|max:255',
            'pla_tratamiento' => 'required|string|max:255',
        ]);

        PlanTratamiento::create($request->all());

        return redirect()->route('plan_tratamiento.index')->with('success', 'Plan creado correctamente.');
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
            'pla_his_id' => 'required|exists:historia_clinica,his_id',
            'pla_diagnostico' => 'required|string|max:255',
            'pla_objetivo_tratamiento' => 'required|string|max:255',
            'pla_tratamiento' => 'required|string|max:255',
        ]);

        $plan = PlanTratamiento::findOrFail($id);
        $plan->update($request->all());

        return redirect()->route('plan_tratamiento.index')->with('success', 'Plan actualizado correctamente.');
    }
}
