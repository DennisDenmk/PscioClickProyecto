<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cedula' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intenta autenticar con la cédula
        if (!Auth::attempt(['cedula' => $request->cedula, 'password' => $request->password], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'cedula' => __('auth.failed'), // Mensaje de error
            ]);
        }

        $request->session()->regenerate();
        // Redirección según el rol
        $user = Auth::user();
        $rol = $user->role->nombre ?? null;

        return match ($rol) {
            'administrador' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'secretario' => redirect()->route('secretario.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
}
