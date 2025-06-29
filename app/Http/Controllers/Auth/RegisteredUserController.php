<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'roles' => \App\Models\Role::all(), // Enviar los roles al formulario
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'cedula' => ['required', 'string', 'size:10', 'unique:users,cedula'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'telefono' => ['required', 'string', 'size:10', 'unique:users,telefono'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role_id' => ['required', 'exists:roles,id'],
            ],
            [
                'cedula.unique' => 'Cédula ya registrada.',
                'email.unique' => 'Correo ya registrado..',
                'telefono.unique' => 'Teléfono ya registrado..',

            ],
        );

        $user = User::create([
            'name' => $request->name,
            'cedula' => $request->cedula,
            'email' => $request->email,
            'telefono' =>$request ->telefono,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect(route('admin.dashboard'));
    }
}
