<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchasesController extends Controller
{
    public function deletePurchase($id)
    {
        $purchase = Purchase::with('purchaseLines')->findOrFail($id);

        // Borra todas las líneas de compra asociadas
        foreach ($purchase->purchaseLines as $line) {
            $line->delete();
        }

        // Borra la compra
        $purchase->delete();

        // Redirige a la vista de administrador con un mensaje de confirmación
        return redirect('admin/Purchase')->with('success', __('messages.purchase_deleted'));
    }

    public function modifyPurchase($id){
        return $id;
    }

    public function showmodifyPurchase($id) {
        return "Not implemented yet";
    }
}
