<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el perfil del usuario.
     *
     * @param  int  $id  ID del usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // Verificar que el usuario autenticado sea el mismo que el perfil solicitado
        if (Auth::id() != $id) {
            abort(403, 'Unauthorized action.');
        }

        // Obtener el usuario desde la base de datos
        $user = User::findOrFail($id);

        // Retornar la vista del perfil con los datos del usuario
        return view('profile', compact('user'));
    }


    public function editProfile($id)
    {
        // Obtener el usuario autenticado
        $authenticatedUser = Auth::user();

        // Verificar que el usuario autenticado sea el mismo que está intentando editar
        if ($authenticatedUser->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        // Obtener el usuario que se está editando
        $user = User::findOrFail($id);

        // Retornar la vista de edición de perfil
        return view('changeProfile', compact('user'));
    }

    /**
     * Actualiza la información del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar el nombre de usuario si se proporciona uno nuevo
        if ($request->filled('username')) {
            $user->username = $request->username;
            $user->save();
        }

        // Actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Perfil actualizado correctamente.');
    }

    public function enableMfa(Request $request)
    {
        $user = Auth::user();

        $user->update(['mfa_enabled' => true]);


        // Redirige al perfil del usuario actual
        return redirect()->route('profile.show', ['id' => $user->id])->with('status', 'MFA habilitado.');
    }

    public function disableMfa(Request $request)
    {
        $user = Auth::user();
        $user->update(['mfa_enabled' => false]);

        return redirect()->route('profile.show', ['id' => $user->id])->with('status', 'MFA deshabilitado.');
    }
}
