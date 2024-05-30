<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MfaController;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function showRegister() {
        return view('register');
    }

    public function loginUser(Request $request){
        $credentials = $request->only('username', 'password');

        if (auth()->validate($credentials)) {
            $user = User::where('username', $credentials['username'])->first();

            if (!$user->confirmed) {
                return redirect()->back()->withErrors(['loginError' => 'Your email has not been confirmed yet.']);
            }

            if ($user->mfa_enabled) {
                Auth::login($user);
                return redirect()->route('mfa.show');
            }

            if (auth()->attempt($credentials)) {
                return redirect()->route('index.show');
            }
        }

        return back()->withErrors([
            'loginError' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registerUser(Request $request){
        return $request->user . ' | ' . $request->passwd . ' | ' . $request->passwd2 . ' | ' . $request->email;
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->mfa_enabled) {
            return redirect()->route('mfa.show');
        } else {
            return redirect('/'); // Redirige a la página principal si la autenticación de doble factor no está habilitada
        }
    }

    // Método para validar el código MFA
    protected function validateMfaCode(Request $request)
    {
        $request->validate(['mfa_code' => 'required|string']);

        $user = Auth::user();

        // Verificar si el código MFA proporcionado coincide con el almacenado en la base de datos
        return $user->mfa_code === $request->mfa_code && now()->lessThanOrEqualTo($user->mfa_code_expires_at);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }
}
