<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\HorarioDoctor;

use Illuminate\Http\Request;

class SecretarioController extends Controller
{
     public function indexHorarioDoctor()
    {
        $horarios = HorarioDoctor::with('doctor')->get();
        return view('doctor.horarios.index', compact('horarios'));
    }

    public function createHorarioDoctor()
    {
        $doctores = Doctor::all();
        return view('doctor.horarios.create', compact('doctores'));
    }

    public function storeHorarioDoctor(Request $request)
    {
        $request->validate([
            'doc_cedula' => 'required|exists:doctores,doc_cedula',
            'hor_dia_semana' => 'nullable|integer|min:1|max:7',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'hor_fecha_especifica' => 'nullable|date',
            'hor_disponible' => 'required|boolean',
        ]);

        HorarioDoctor::create($request->all());

        return redirect()->route('horarios_doctor.index')->with('success', 'Horario creado correctamente.');
    }

    public function editHorarioDoctor($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        $doctores = Doctor::all();
        return view('doctor.horarios_doctor.edit', compact('horario', 'doctores'));
    }

    public function updateHorarioDoctor(Request $request, $id)
    {
        $request->validate([
            'doc_cedula' => 'required|exists:doctores,doc_cedula',
            'hor_dia_semana' => 'nullable|string',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'hor_fecha_especifica' => 'nullable|date',
            'hor_disponible' => 'required|boolean',
        ]);

        $horario = HorarioDoctor::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('horarios_doctor.index')->with('success', 'Horario actualizado correctamente.');
    }
}
