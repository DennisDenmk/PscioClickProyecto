<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Doctor;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        dd($validated);

        // Guardar datos en la tabla users
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Si el usuario tiene rol de doctor, actualizar también en la tabla doctores
        if ($user->role && $user->role->nombre === 'doctor') {
            $doctor = Doctor::where('doc_cedula', $user->getOriginal('cedula'))->first();

            if ($doctor) {
                $doctor->update([
                    'doc_cedula' => $user->cedula,
                    'doc_nombres' => $user->name,
                    'doc_apellidos' => $user->apellido,
                    'doc_telefono' => $user->telefono,
                    'doc_email' => $user->email,
                ]);
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
   
}
