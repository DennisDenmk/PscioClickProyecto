<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use App\Models\HistoriaClinica;
use App\Models\DetalleHistoria;

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
}
