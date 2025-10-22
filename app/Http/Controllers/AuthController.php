<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro de usuario
     */
    public function register(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'tipo_documento' => 'required|string|in:CC,CE,TI,PAS',
            'numero_documento' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'numero_documento.unique' => 'Este número de documento ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Si la validación falla, retornar errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->nombres . ' ' . $request->apellidos,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'rol' => 'comprador', // Se asigna automáticamente el rol comprador
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir al login con mensaje de éxito
        return redirect()->route('login')->with('success', '¡Registro exitoso! Bienvenido/a ' . $user->nombres);
    }

    /**
     * Mostrar formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validar credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirección según rol
            if ($user->rol === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Bienvenido administrador');
            } elseif ($user->rol === 'comprador') {
                return redirect()->route('comprador.index')->with('success', 'Bienvenido comprador');
            } else {
                // Rol desconocido
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'Rol no autorizado']);
            }
        }

        // Si falla la autenticación
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }
}