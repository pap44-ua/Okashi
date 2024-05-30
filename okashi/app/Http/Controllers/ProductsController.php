<?php
// app/Http/Controllers/ProductsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductsController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function showListProducts()
    {
        $products = $this->productService->getAllProducts();
        return view('products', ['products' => $products]);
    }

    public function showProductDetails($id)
    {
        $p = $this->productService->getProductById($id);
        $recommended = $this->productService->getAllProductsForRecommendation();
        return view('productDetails', ['p' => $p, 'recommended' => $recommended]);
    }

    public function showModifyProduct($id)
    {
        $p = $this->productService->getProductById($id);
        return view('modifyProduct', ['p' => $p]);
    }

    public function buyProduct(Request $request, $id)
    {
        // Implement buy logic
        return $id . ' | ' . $request->quantity;
    }

    public function deleteProduct($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->back();
    }

    public function modifyProduct(Request $request, $id)
    {
        $this->productService->updateProduct($request, $id);
        return redirect('/admin/Product');
    }

    public function searchProduct(Request $request)
    {
        $name = $request->get('name', '');
        $price = $request->get('price', 0);
        $results = $this->productService->searchProducts($name, $price);
        return view('search', ['results' => $results, 'name' => $name, 'price' => $price]);
    }

    public function createProduct(Request $request)
    {
        // Verificar si el usuario está autenticado y es administrador
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403); // Prohibido
        }

        $this->productService->createProduct($request);
        return redirect('/admin/Product');
    }
}
