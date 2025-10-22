<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function edit()
    {
        // Creamos una nueva vista para esto
        return view('profile.password'); 
    }

    /**
     * Actualiza la contraseña del usuario.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validar los datos
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // 2. Validar que la contraseña actual sea correcta
        if (!Hash::check($data['current_password'], $user->password)) {
            // Si no coincide, lanzar un error de validación
            throw ValidationException::withMessages([
                'current_password' => 'La contraseña actual no es correcta.',
            ]);
        }

        // 3. Actualizar la nueva contraseña
        $user->password = Hash::make($data['password']);
        $user->save();

        session()->flash('message', 'Contraseña actualizada exitosamente');
        return redirect()->route('profile.password.edit');
    }
}
