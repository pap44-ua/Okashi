<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; // Importar la clase Str
use App\Mail\ConfirmationCodeMail;
use App\Helpers\ValidationHelper;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario utilizando ValidationHelper
        $validationEmail = ValidationHelper::validarCampo('correo', $request->email_address);
        if ($validationEmail !== true) {
            return redirect()->route('register.show')->withErrors(['email_address' => $validationEmail]);
        }

        $validationPassword = ValidationHelper::validarCampo('contrasena', $request->password);
        if ($validationPassword !== true) {
            return redirect()->route('register.show')->withErrors(['password' => $validationPassword]);
        }

        // Verificar que la contraseña y su confirmación sean iguales
        if ($request->password !== $request->password_confirmation) {
            return redirect()->route('register.show')->withErrors(['password_confirmation' => __('messages.password_mismatch')]);
        }

        // Verificar si el correo electrónico ya existe en la base de datos
        if (User::where('email_address', $request->email_address)->exists()) {
            return redirect()->route('register.show')->withErrors(['email_address' => __('messages.email_registered')]);
        }

        // Verificar si el correo electrónico ya existe en la base de datos
        if (User::where('email_address', $request->email_address)->exists()) {
            return redirect()->route('register.show')->withErrors(['email_address' => 'El correo electrónico ya está registrado.']);
        }

        // Generar un código de confirmación
        $confirmationCode = Str::random(25);

        // Crear un nuevo usuario en la base de datos
        $user = User::create([
            'username' => $request->username,
            'email_address' => $request->email_address,
            'password' => Hash::make($request->password),
            'confirmation_code' => $confirmationCode,
        ]);

        // Definir los datos para el correo electrónico
        $data = [
            'name' => $user->username,
            'email_address' => $user->email_address,
            'confirmation_code' => $confirmationCode,
        ];

        // Enviar el correo de confirmación
        Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
            $message->to($data['email_address'], $data['name'])->subject('Por favor confirma tu correo');
        });

        Auth::logout();

        // Redirigir a una página de confirmación o a otra página de tu elección
        return redirect()->route('login')->with('success', __('messages.registration_successful'));
    }
}
