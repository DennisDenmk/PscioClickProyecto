<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexUser()
    {
        $users = User::with('role')->get();

        return view('admin.usuarios.index', compact('users'));
    }

    // Mostrar el formulario para editar un usuario
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    // Actualizar los datos del usuario
    public function updateUser(Request $request, $id)
    {
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

        $user = User::findOrFail($id);
        $validatedData = $request->only(['name', 'cedula', 'email', 'role_id', 'estado']);
        $validatedData['estado'] = $estadoBooleano; 
        $user->update($validatedData); 

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
}
