<?php
namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function __construct()
    {
        // Solo secretarios pueden gestionar pacientes
        $this->middleware(['auth', 'rol:secretario']);
    }

    public function index()
    {
        $pacientes = Paciente::with('estadoCivil')->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $estadosCiviles = EstadoCivil::all();
        return view('pacientes.create', compact('estadosCiviles'));
    }

    public function store(Request $request)
    {
        $this->validatePaciente($request);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function edit($pac_cedula)
    {
        $paciente = Paciente::findOrFail($pac_cedula);
        $estadosCiviles = EstadoCivil::all();
        return view('pacientes.edit', compact('paciente', 'estadosCiviles'));
    }

    public function update(Request $request, $pac_cedula)
    {
        $paciente = Paciente::findOrFail($pac_cedula);
        $this->validatePaciente($request, $pac_cedula);
        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    protected function validatePaciente(Request $request, $cedula = null)
    {
        $rules = [
            'pac_cedula' => ['required', 'string', 'size:10', $cedula ? 'unique:pacientes,pac_cedula,' . $cedula . ',pac_cedula' : 'unique:pacientes,pac_cedula'],
            'pac_nombres' => 'required|string|max:75',
            'pac_apellidos' => 'required|string|max:75',
            'pac_sexo' => 'required|boolean',
            'pac_fecha_nacimiento' => 'required|date|before:today',
            'estc_id' => 'required|exists:estados_civiles,estc_id',
            'pac_profesion' => 'nullable|string|max:50',
            'pac_ocupacion' => 'nullable|string|max:50',
            'pac_telefono' => 'nullable|string|size:10',
            'pac_direccion' => 'nullable|string',
            'pac_email' => ['nullable', 'email', 'max:125', $cedula ? 'unique:pacientes,pac_email,' . $cedula . ',pac_cedula' : 'unique:pacientes,pac_email'],
        ];

        $request->validate($rules);
    }
    public function show($cedula)
    {
        $paciente = Paciente::with(['estadoCivil', 'historiaClinica'])->findOrFail($cedula);
        return view('pacientes.show', compact('paciente'));
    }
     public function indexEstadoCivil()
    {
        $estados = EstadoCivil::all();
        return view('pacientes.estado_civil.index', compact('estados'));
    }

    public function createEstadoCivil()
    {
        return view('pacientes.estado_civil.create');
    }

    public function storeEstadoCivil(Request $request)
    {
        $request->validate([
            'estc_nombre' => 'required|string|max:100|unique:estados_civiles,estc_nombre',
        ]);

        EstadoCivil::create($request->all());

        return redirect()->route('estado_civil.index')->with('success', 'Estado civil creado correctamente.');
    }

    public function editEstadoCivil($id)
    {
        $estado = EstadoCivil::findOrFail($id);
        return view('pacientes.estado_civil.edit', compact('estado'));
    }

    public function updateEstadoCivil(Request $request, $id)
    {
        $request->validate([
            'estc_nombre' => 'required|string|max:100|unique:estados_civiles,estc_nombre,' . $id . ',estc_id',
        ]);

        $estado = EstadoCivil::findOrFail($id);
        $estado->update($request->all());

        return redirect()->route('estado_civil.index')->with('success', 'Estado civil actualizado.');
    }
}
