<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;

class AddressesController extends Controller
{
    public function showModifyAddress($id) {
        $p = Address::findOrFail($id);
        return view('modifyAddress', ['p' => $p]);
    }

    public function deleteAddress($id){
        // Buscar la dirección por su ID
        $address = Address::findOrFail($id);
    
        // Eliminar la dirección de la base de datos
        $address->delete();
    
        // Redirigir a alguna página de éxito o a donde desees
        return redirect('admin/Address');
    }

    public function showCreateAddressForm() {
        $users = User::all();
        return view('createAddress', ['users' => $users]);
    }

    public function createAddress(Request $request){
        // Valida que el usuario actual sea un administrador
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403); // Prohibido
        }

        // Validar los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
        ]);

        // Crear la dirección
        $address = Address::create([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        // Asociar la dirección al usuario especificado
        User::find($request->user_id)->addresses()->attach($address->id);

        return redirect('admin/Address');
    }

    public function modifyAddress(Request $request, $id)
    {
        // Buscar la dirección por su ID
        $address = Address::findOrFail($id);

        // Actualizar los campos de la dirección con los datos de la solicitud
        $address->street = $request->input('street');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->postal_code = $request->input('postal_code');
        $address->country = $request->input('country');

        // Guardar los cambios en la base de datos
        $address->save();

        // Redirigir a alguna página de éxito o a donde desees
        return redirect('admin/Address');
    }

    
}
