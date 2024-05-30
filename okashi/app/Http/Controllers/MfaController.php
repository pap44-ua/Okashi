<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\MfaCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MfaController extends Controller
{
    // Mostrar el formulario para ingresar el código MFA
    public function showMfaForm()
    {
        // Verificar si hay un usuario autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar si el usuario tiene habilitada la autenticación de doble factor
            if ($user->mfa_enabled) {
                $this->sendMfaCode($user);
                // Si mfa_enabled es 1, el usuario ya tiene habilitado MFA, así que mostrar la vista mfa.blade.php
                return view('auth.mfa');

            } else {
                // Si mfa_enabled es 0, el usuario no tiene habilitado MFA, así que redirigir a la página de inicio
                return redirect()->intended('/');
            }
        } else {
            // Si no hay usuario autenticado, redirigir al formulario de inicio de sesión
            return redirect()->route('login');
        }
    }

    // Enviar el código MFA por correo electrónico
    public function sendMfaCode(User $user) // Cambié Request a User
    {
        $code = Str::random(6);

        $user->update([
            'mfa_code' => $code,
            'mfa_code_expires_at' => Carbon::now()->addMinutes(30),
        ]);

        $data = [
            'code' => $code,
            'name' => $user->username,
            'email_address' => $user->email_address,
        ];

        Mail::send('mfa_code', $data, function ($message) use ($data) {
            $message->to($data['email_address'], $data['name'])->subject('Código de Autenticación de Doble Factor');
        });

        return back()->with('success', 'El código MFA ha sido enviado a tu correo electrónico.');
    }



    // Verificar el código MFA ingresado por el usuario
    public function verifyMfaCode(Request $request)
    {
        $request->validate(['mfa_code' => 'required|string']);

        $user = Auth::user();

        if ($user && $user->mfa_code === $request->mfa_code && Carbon::now()->lessThanOrEqualTo($user->mfa_code_expires_at)) {
            $user->update(['mfa_code' => null, 'mfa_code_expires_at' => null, 'mfa_verified' => true]);

            Auth::login($user);

            return redirect()->intended('/');
        } else {
            return back()->withErrors(['mfa_code' => 'El código de verificación es incorrecto o ha expirado.']);
        }
    }
}
