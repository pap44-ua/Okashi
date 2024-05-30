<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function showAdmin() {
        $re = new Request();
        return $this->listDB($re, "Product");
    }

    public function listDB(Request $request, $func)
    {
        $order = "asc";

        if ($request->idOrder == "asc" || $request->idOrder == "desc") {
            $order = $request->idOrder;
        }

        $model = app("App\Models\\$func");
        $item = $model::first();

        if ($item) {
            $h = array_keys($item->getOriginal());
        } else {
            $h = []; // Otra acción por defecto si $item es nulo
        }

        $d = $model::orderBy('id', $order)->paginate(10);

        return view('admin', ['headers' => $h, 'data' => $d, 'table' => $func, 'order' => $order]);
    }

}