<?php

namespace App\Http\Controllers;

use App\Models\TipoCita;
use App\Models\Promocion;
use App\Models\PromocionCita;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\EstadoCita;
use App\Models\HorarioDoctor;

use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function show($id)
    {
        $cita = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita', 'historiaClinica'])->findOrFail($id);

        return view('citas.show', compact('cita'));
    }
    public function createTipoCita()
    {
        return view('citas.tiposcita.create');
    }
    public function storeTipoCita(Request $request)
    {
        $request->validate(
            [
                'tipc_nombre' => 'required|string|max:100|unique:tipo_citas,tipc_nombre',
                'tipc_duracion_minutos' => 'required|integer|min:1',
            ],
            [
                'tipc_nombre.unique' => 'Ya existe un tipo de cita con ese nombre.',
            ],
        );

        TipoCita::create($request->all());

        return redirect()->route('tipocita.index')->with('success', 'Tipo de cita creado correctamente.');
    }

    public function indexTipoCita()
    {
        $tipos = TipoCita::all();
        return view('citas.tiposcita.index', compact('tipos'));
    }

    public function editTipoCita($id)
    {
        $tipo = TipoCita::findOrFail($id);
        return view('citas.tiposcita.edit', compact('tipo'));
    }

    public function updateTipoCita(Request $request, $id)
    {
        $request->validate([
            'tipc_nombre' => 'required|string|max:100',
            'tipc_duracion_minutos' => 'required|integer|min:1',
        ]);

        $tipo = TipoCita::findOrFail($id);
        $tipo->update($request->all());

        return redirect()->route('tipocita.index')->with('success', 'Tipo de cita actualizado correctamente.');
    }
    //Promociones
    public function indexPromocion()
    {
        $promociones = Promocion::all();
        return view('citas.promocion.index', compact('promociones'));
    }

    public function createPromocion()
    {
        return view('citas.promocion.create');
    }

    public function storePromocion(Request $request)
    {
        $request->validate([
            'prom_nombre' => 'required|string|max:100',
            'prom_descripcion' => 'nullable|string',
            'prom_precio' => 'required|numeric',
            'prom_sesiones' => 'required|integer|min:1',
        ]);

        Promocion::create($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción creada correctamente.');
    }

    public function editPromocion($id)
    {
        $promocion = Promocion::findOrFail($id);
        return view('citas.promocion.edit', compact('promocion'));
    }

    public function updatePromocion(Request $request, $id)
    {
        $request->validate([
            'prom_nombre' => 'required|string|max:100',
            'prom_descripcion' => 'nullable|string',
            'prom_precio' => 'required|numeric',
            'prom_sesiones' => 'required|integer|min:1',
        ]);

        $promocion = Promocion::findOrFail($id);
        $promocion->update($request->all());
        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada correctamente.');
    }
    public function indexPromocionCita()
    {
        $promocionesCitas = PromocionCita::with('cita', 'promocion')->get();
        return view('citas.promocioncita.index', compact('promocionesCitas'));
    }

    public function createPromocionCita()
    {
        $citas = Cita::all();
        $promociones = Promocion::all();
        return view('citas.promocioncita.create', compact('citas', 'promociones'));
    }

    public function storePromocionCita(Request $request)
    {
        $request->validate([
            'cit_id' => 'required|exists:citas,cit_id',
            'proc_id' => 'required|exists:promociones,prom_id',
            'proc_sesiones_usadas' => 'required|integer|min:0',
        ]);

        PromocionCita::create($request->all());

        return redirect()->route('promocioncita.index')->with('success', 'Registro creado exitosamente');
    }

    public function editPromocionCita($id)
    {
        $promocionCita = PromocionCita::findOrFail($id);
        $citas = Cita::all();
        $promociones = Promocion::all();

        return view('citas.promocioncita.edit', compact('promocionCita', 'citas', 'promociones'));
    }

    public function updatePromocionCita(Request $request, $id)
    {
        $request->validate([
            'cit_id' => 'required|exists:citas,cit_id',
            'proc_id' => 'required|exists:promociones,prom_id',
            'proc_sesiones_usadas' => 'required|integer|min:0',
        ]);

        $promocionCita = PromocionCita::findOrFail($id);
        $promocionCita->update($request->all());

        return redirect()->route('promocioncita.index')->with('success', 'Registro actualizado correctamente');
    }
    public function indexCita()
    {
        $citas = Cita::with(['paciente', 'doctor', 'tipoCita', 'estadoCita'])->get();
        return view('citas.index', compact('citas'));
    }

    public function createCita()
    {
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $tipos = TipoCita::all();
        $estados = EstadoCita::all();

        return view('citas.create', compact('pacientes', 'doctores', 'tipos', 'estados'));
    }

    public function storeCita(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,pac_cedula',
            'doctor_id' => 'required|exists:doctores,doc_cedula',
            'tipc_id' => 'required|exists:tipo_citas,tipc_id',
            'estc_id' => 'required|exists:estado_citas,estc_id',
            'cit_fecha' => 'required|date',
            'cit_hora_inicio' => 'required',
            'cit_hora_fin' => 'required',
            'cit_motivo_consulta' => 'required|string',
        ]);

        // Buscar la historia clínica del paciente
        $historia = \App\Models\HistoriaClinica::where('pac_id', $request->paciente_id)->first();

        if (!$historia) {
            return back()
                ->withErrors(['paciente_id' => 'El paciente no tiene una historia clínica registrada.'])
                ->withInput();
        }

        // Crear la cita
        Cita::create([
            'paciente_id' => $request->paciente_id,
            'doctor_id' => $request->doctor_id,
            'tipc_id' => $request->tipc_id,
            'estc_id' => $request->estc_id,
            'cit_fecha' => $request->cit_fecha,
            'cit_hora_inicio' => $request->cit_hora_inicio,
            'cit_hora_fin' => $request->cit_hora_fin,
            'cit_motivo_consulta' => $request->cit_motivo_consulta,
            'his_id' => $historia->his_id, // <- asignación automática
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita creada correctamente.');
    }

    public function editCita($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = Paciente::all();
        $doctores = Doctor::all();
        $tipos = TipoCita::all();
        $estados = EstadoCita::all();

        return view('citas.edit', compact('cita', 'pacientes', 'doctores', 'tipos', 'estados'));
    }

    public function updateCita(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,pac_cedula',
            'doctor_id' => 'required|exists:doctores,doc_cedula',
            'tipc_id' => 'required|exists:tipo_citas,tipc_id',
            'estc_id' => 'required|exists:estado_cita,estc_id',
            'cit_fecha' => 'required|date',
            'cit_hora_inicio' => 'required|date_format:H:i',
            'cit_hora_fin' => 'required|date_format:H:i|after:cit_hora_inicio',
            'cit_motivo_consulta' => 'nullable|string|max:255',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');
    }
    public function citasCalendario(): JsonResponse
    {
        $citas = Cita::with(['paciente', 'doctor', 'tipoCita'])->get();

        // Transformar citas al formato esperado por FullCalendar
        $eventos = $citas->map(function ($cita) {
            return [
                'id' => $cita->cit_id,
                'title' => "{$cita->tipoCita->tipc_nombre} - {$cita->paciente->pac_nombres} {$cita->paciente->pac_apellidos}",
                'estado' =>"{$cita->estadoCita->estc_nombre}",
                'start' => $cita->cit_fecha . 'T' . $cita->cit_hora_inicio,
                'end' => $cita->cit_fecha . 'T' . $cita->cit_hora_fin,
                'url' => route('citas.show', $cita->cit_id),
            ];
        });

        return response()->json($eventos);
    }
    public function mostrarCalendario()
    {
        return view('citas.calendario');
    }
}
