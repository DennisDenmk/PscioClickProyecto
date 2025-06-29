<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
                'cedula' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'role_id' => 'required|exists:roles,id',
                'estado' => 'required|boolean',
            ],
            [
                'cedula.unique' => 'Cédula ya existe en el sistema',
                'email.unique' => 'Correo ya existe en el sistema',
            ],
        );
        $estadoBooleano = filter_var($request->estado, FILTER_VALIDATE_BOOLEAN);

        $validatedData = $request->only(['name', 'cedula', 'email', 'role_id', 'estado']);
        $validatedData['estado'] = $estadoBooleano;
        $user->update($validatedData);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
}
