<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\HorarioDoctor;

use Illuminate\Http\Request;

class SecretarioController extends Controller
{
    public function index()
    {
        $totalDoctores = Doctor::totalDoctores();
        $totalPacientes = Paciente::totalPacientes();
        $citasHoy = Cita::citasDeHoy();
        $personalActivo = User::totalUsuariosActivos();
        return view('secretario.dashboards', compact('totalPacientes', 'totalDoctores', 'citasHoy','personalActivo'));
    }

}
