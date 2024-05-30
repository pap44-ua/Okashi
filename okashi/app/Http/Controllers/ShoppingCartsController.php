<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// TODO
class ShoppingCartsController extends Controller
{
    public static function getLatestCart(){
        $idUsu = auth()->user()->id;
        $cart = ShoppingCart::where('comprado', '=', false)->get();
        if($cart->count() == 0){
            $shoppingCart = new ShoppingCart();
            $shoppingCart->user()->associate(auth()->user()->id); // Asociar el carrito con el usuario actual
            $shoppingCart->comprado = false;
            $shoppingCart->save();
            return $shoppingCart;
        }
        return $cart->first();
    }

    public function showCart($id) {
        $cart = ShoppingCart::find($id);
        $products = $cart->products->all();

        $quantities = [];
        $total = 0;
        foreach($products as $p){
            $quantities[$p->id] = $p->pivot->quantity;
            $total += $p->price * $p->pivot->quantity;
        }

        return view('cart', ['products' => $products, 'quantities' => $quantities, 'price' => $total, 'id' => $id]);
    }

    public function showCurrentCart() {
        $cart = ShoppingCartsController::getLatestCart();
        return $this->showCart($cart->id);
    }

    public function deleteShoppingCart($id){
        $s = ShoppingCart::findOrFail($id);
    
        // Eliminar la dirección de la base de datos
        $s->delete();
    
        // Redirigir a alguna página de éxito o a donde desees
        //return redirect('admin/ShoppingCart');
        return redirect()->back();
    }

    public function modifyShoppingCart($id){
        return $id;
    }

    public function addProductToCart(Request $request) {
        // Create a new item in the shopping cart
        $cart = ShoppingCartsController::getLatestCart();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $products = $cart->products;
        if($products->contains($productId)){
            $q = $cart->products()->find($productId)->pivot->quantity;
            $cart->products()->updateExistingPivot($productId, ['quantity' => $q + $quantity], false);
        }
        else{
            // Adjuntar productos al carrito de compras (ajusta según sea necesario)
            $cart->products()->attach($request->product_id, ['quantity' => $request->quantity]);
        }
        
        // Redirect back to the shopping cart page
        return redirect('shoppingCart');
    }

    public function modifyProductQuantity(Request $request, $id){
        $cart = ShoppingCart::find($id);
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity], false);

        return redirect('shoppingCart');
    }

    public function deleteProduct(Request $request, $id)
    {   
        $cart = ShoppingCart::find($id);
        $productId = $request->product_id;

        // Eliminar el producto del carrito utilizando el método detach()
        $cart->products()->detach($productId);

        return redirect('shoppingCart');
    }
    
    public function buyCart(Request $request, $id)
    {
        // Obtén la id de la tarjeta de crédito desde la solicitud
        $cardId = $request->card_id;

        // Encuentra el carrito de compras y la tarjeta de crédito con las ids proporcionadas
        $cart = ShoppingCart::findOrFail($id);
        $card = Card::findOrFail($cardId);

        $total = 0;
        foreach ($cart->products as $item) {
            $total += $item->price * $item->pivot->quantity;
        }

        $card->balance -= $total;
        $card->save();

        // Disminuir el stock de los productos
        foreach ($cart->products as $item) {
            $product = $item;
            $product->stock -= $item->pivot->quantity;
            $product->save();
        }

        // Marcar el carrito como comprado
        $cart->comprado = true;
        $cart->save();

        // Obtener el correo del usuario autenticado
        $userEmail = Auth::user()->email_address;

        // Enviar correo con la información
        Mail::send('emails.payment_confirmation', [
            'cartItems' => $cart->products,
            'total' => $total
        ], function ($message) use ($userEmail) {
            $message->to($userEmail)
                    ->subject('Payment Confirmation');
        });

        // Redirige al carro
        return redirect('/shoppingCart')->with('success', 'Payment confirmed and email sent!');
    }


    public function showModifyShoppingCart($id) {
        return "Not implemented yet";
    }
}
