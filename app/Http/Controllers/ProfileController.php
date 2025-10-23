<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        // CORREGIDO: Apunta a tu archivo 'profile.index'
        return view('profile.index', compact('user'));
    }

    /**
     * Actualiza los datos del perfil (RF11).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

    // 1. VALIDACIÓN
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'apellidos' => 'required|string|max:100',
        'email' => [
            'required', 'string', 'email', 'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'telefono' => 'nullable|string|max:20',
        'password' => ['nullable', 'confirmed', Password::min(8)], // (Si todavía manejas password aquí)
    ]);

    // 2. ACTUALIZACIÓN
    $user->name = $data['name'];
    $user->apellidos = $data['apellidos'];
    $user->email = $data['email'];
    $user->telefono = $data['telefono'];

    if (!empty($data['password'])) {
        $user->password = Hash::make($data['password']);
    }

    $user->save();

    session()->flash('message', 'Perfil actualizado exitosamente');
    return redirect()->route('profile.edit');
    }
}
