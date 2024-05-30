<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\ShoppingCartsController;
use App\Models\ShoppingCart;

class CardController extends Controller
{
    public function create()
    {
        return view('createCard');
    }

    public function showCheckout()
    {
        // Obtén las tarjetas del usuario actual
        $cards = auth()->user()->cards;

        // Si el usuario no tiene tarjetas, redirígelo a la vista de añadir tarjeta
        if ($cards->isEmpty()) {
            session(['cartCard' => 1]);
            return redirect()->route('Card.create');
        }

        // Si el usuario tiene tarjetas, muéstralas en una vista
        return view('checkout', ['cards' => $cards, 'cart_id' => ShoppingCartsController::getLatestCart()->id]);
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'card_name' => 'required',
            'card_number' => 'required|unique:cards',
            'cvv' => 'required',
            'expiry_date' => 'required|date',
        ]);

        // Crear la tarjeta
        $card = new Card;
        $card->user_id = auth()->user()->id; // Asigna la ID del usuario autenticado
        $card->card_name = $request->card_name;
        $card->card_number = $request->card_number;
        $card->cvv = $request->cvv;
        $card->expiry_date = $request->expiry_date;
        $card->balance = 100;
        $card->save();

        if(session('cartCard')){
            session(['cartCard' => 0]);
            return redirect('/shoppingCart');
        }

        return redirect()->back();
    }

    public function modifyCard(Request $request, $id)
    {
        // Buscar la tarjeta por su ID
        $card = Card::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'card_name' => 'required',
            'card_number' => 'required|unique:cards,card_number,' . $card->id,
            'cvv' => 'required',
            'expiry_date' => 'required|date',
        ]);

        // Actualizar los campos de la tarjeta con los nuevos datos del formulario
        $card->card_name = $request->input('card_name');
        $card->card_number = $request->input('card_number');
        $card->cvv = $request->input('cvv');
        $card->expiry_date = $request->input('expiry_date');

        // Guardar los cambios en la base de datos
        $card->save();

        // Redirigir a alguna página de éxito o a donde desees
        return redirect('/admin/Card');
    }

    public function deleteCard($id)
    {
        // Buscar la tarjeta por su ID
        $card = Card::findOrFail($id);

        // Eliminar la tarjeta de la base de datos
        $card->delete();

        // Redirigir a alguna página de éxito o a donde desees
        return redirect('/admin/Card');
    }

    public function processPayment(Request $request)
    {
        // Obtén la tarjeta y el CVV del formulario
        $card = Card::findOrFail($request->card_id);
        $cvv = $request->cvv;

        // Comprueba si el CVV coincide
        if ($card->cvv != $cvv) {
            return back()->withErrors([__('errors.cvv_mismatch')]);
        }

        // Encuentra el carrito de compras con la id proporcionada
        $cart = ShoppingCart::findOrFail($request->cart_id);

        // Calcula el total del carrito de compras
        $total = 0;
        foreach ($cart->products as $item) {
            $total += $item->price * $item->pivot->quantity;
        }

        // Comprueba si hay suficiente saldo en la tarjeta
        if ($card->balance < $total) {
            return back()->withErrors([__('errors.insufficient_balance')]);
        }

        // Redirige a confirmación de pago
        return view('confirmPayment', ['total' => $total, 'card_id' => $request->card_id, 'cart_id' => $request->cart_id]);
    }

    public function showModifyCard($id) {
        return "Not implemented yet";
    }
}
