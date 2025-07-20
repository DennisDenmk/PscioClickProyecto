<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Cita;
use Illuminate\Http\Request;
use App\Rules\EmailValido;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    public function index()
    {
        $totalDoctores = Doctor::totalDoctores();
        $totalPacientes = Paciente::totalPacientes();
        $citasHoy = Cita::citasDeHoy();
        return view('admin.dashboards', compact('totalPacientes', 'totalDoctores', 'citasHoy'));
    }
    public function indexUser()
    {
        $users = User::with('role')->get();

        return view('admin.usuarios.index', compact('users'));
    }

    // Mostrar el formulario para editar un usuario
    public function editUser($cedula)
    {
        $user = User::where('cedula', $cedula)->firstOrFail();

        if ((string) $cedula === (string) Auth::id()) {
            // Redirige de vuelta a la lista de usuarios con un mensaje de error
            return redirect()->route('usuarios.index')->with('error', 'No puedes editar tu propia cuenta desde este panel. Por favor, utiliza la sección de perfil si deseas modificarla.');
        }
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    // Actualizar los datos del usuario
    public function updateUser(Request $request, $cedula)
{
    $user = User::where('cedula', $cedula)->firstOrFail();

    if ((string) $cedula === (string) Auth::id()) {
        abort(403, 'No puedes editar tu propia cuenta desde este panel.');
    }

    $request->validate(
        [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'cedula' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'cedula')->ignore($cedula, 'cedula'),
            ],
            'email' => [
                'required',
                'email',
                'max:125',
                new EmailValido(),
                // Evita duplicado en usuarios excepto en el actual
                Rule::unique('users', 'email')->ignore($cedula, 'cedula'),
                // Evita duplicado en doctores excepto si es el mismo doctor
                Rule::unique('doctores', 'doc_email')->ignore($cedula, 'doc_cedula'),
            ],
            'role_id' => 'required|exists:roles,id',
            'estado' => 'required|boolean',
        ],
        [
            'cedula.unique' => 'Cédula ya existe en el sistema',
            'email.unique' => 'Correo ya existe en el sistema',
        ]
    );

    $estadoBooleano = filter_var($request->estado, FILTER_VALIDATE_BOOLEAN);

    $validatedData = $request->only([
        'name',
        'apellido',
        'telefono',
        'cedula',
        'email',
        'role_id',
        'estado',
    ]);
    $validatedData['estado'] = $estadoBooleano;

    $user->fill($validatedData);
    $user->save();

    // ✅ Si el usuario es doctor, actualiza también en la tabla doctores
    if ($user->role && $user->role->nombre === 'doctor') {
        $doctor = \App\Models\Doctor::where('doc_cedula', $cedula)->first();

        if ($doctor) {
            $doctor->update([
                'doc_cedula'    => $user->cedula,
                'doc_nombres'   => $user->name,
                'doc_apellidos' => $user->apellido,
                'doc_telefono'  => $user->telefono,
                'doc_email'     => $user->email,
            ]);
        }
    }

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
}
}
