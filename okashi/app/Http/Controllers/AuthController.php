<?php

namespace App\Http\Controllers\;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google_error' => 'Hubo un problema al iniciar sesión con Google. Por favor, inténtalo de nuevo.']);
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // Lógica para registrar al usuario o iniciar sesión
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google_error' => 'Hubo un problema al iniciar sesión con Google. Por favor, inténtalo de nuevo.']);
        }
    }
}


