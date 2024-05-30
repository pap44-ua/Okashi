<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseLine;

class PurchaseLinesController extends Controller
{
    public function deletePurchaseLine($id){
        $p = PurchaseLine::findOrFail($id);
    
        // Eliminar la dirección de la base de datos
        $p->delete();
    
        // Redirigir a alguna página de éxito o a donde desees
        return redirect('admin/PurchaseLine');
    }

    public function modifyPurchaseLine($id){
        return $id;
    }

    public function showmodifyPurchaseLine($id) {
        return "Not implemented yet";
    }
}
