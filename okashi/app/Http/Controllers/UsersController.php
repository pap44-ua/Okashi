<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ValidationHelper;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;

class UsersController extends Controller
{
    public function showModifyUser($id) {
        $p = User::findOrFail($id);
        return view('modifyUser', ['p' => $p]);
    }

    public function deleteUser($id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Eliminar al usuario de la base de datos
        $user->delete();

        // Redirigir a alguna página de éxito o a donde desees
        return redirect('/admin/User');
    }

    public function modifyUser(Request $request, $id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Actualizar los campos del usuario con los nuevos datos del formulario
        $user->username = $request->input('username');

        $validationEmail = ValidationHelper::validarCampo('correo', $request->email_address);

        if ($validationEmail !== true) {
            return __('messages.invalid_email');
        }

        // Verificar si el correo electrónico ya existe en la base de datos
        if ($user->email_address != $request->input('email_address') && User::where('email_address', $request->email_address)->exists()) {
            return __('messages.email_registered');
        }

        $user->email_address = $request->input('email_address');

        if ($request->filled('passwd')) {

            $validationPassword = ValidationHelper::validarCampo('contrasena', $request->passwd);
            if ($validationPassword !== true) {
                return __('messages.invalid_password');
            }

            $user->password = Hash::make($request->passwd);
        }

        $user->is_admin = $request->is_admin;
        $user->confirmed = $request->is_confirmed;

        // Guardar los cambios en la base de datos
        $user->save();

        // Redirigir a alguna página de éxito o a donde desees
        return redirect('/admin/User');
    }

    public function createUser(Request $request){
        // Validar los datos del formulario utilizando ValidationHelper
        $validationEmail = ValidationHelper::validarCampo('correo', $request->email_address);
        if ($validationEmail !== true) {
            return __('messages.invalid_email');
        }

        $validationPassword = ValidationHelper::validarCampo('contrasena', $request->passwd);
        if ($validationPassword !== true) {
            return __('messages.invalid_password');
        }

        // Verificar si el correo electrónico ya existe en la base de datos
        if (User::where('email_address', $request->email_address)->exists()) {
            return __('messages.email_registered');
        }

        // Crear un nuevo usuario en la base de datos
        $user = new User();
        $user->username = $request->username;
        $user->email_address = $request->email_address;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/User');
    }

    public function addAddressByUser(Request $request) {
        // Validar los datos del formulario
        $request->validate([
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ]);

        // Crear la dirección asociada al usuario autenticado
        auth()->user()->addresses()->create([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return redirect()->back()->with('success', __('messages.address_added'));
    }
}
