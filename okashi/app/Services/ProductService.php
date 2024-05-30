<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function getAllProducts($pagination = 10)
    {
        return Product::where('stock', '>', 0)->paginate($pagination);
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function getAllProductsForRecommendation($limit = 5)
    {
        $allProducts = Product::all();
        return $allProducts->count() >= $limit ? $allProducts->random($limit) : $allProducts;
    }

    public function createProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->stock = $request->stock;
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/products');
            $product->image = basename($path);
        }
        
        $product->save();

        return $product;
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->brand = $request->input('brand');
        $product->stock = $request->input('stock');
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/products');
            $product->image = basename($path);
        }

        $product->save();

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return true;
    }

    public function searchProducts($name = "", $price = 0, $pagination = 10)
    {
        if($name == "" && $price <= 0){
            return Product::paginate($pagination);
        }
        else if($name == "" && $price > 0){
            return Product::where('price', '<', $price)->paginate($pagination);
        }
        else if($name != "" && $price <= 0){
            return Product::where('name', 'LIKE', "%{$name}%")->paginate($pagination);
        }
        else{
            return Product::where('name', 'LIKE', "%{$name}%")->where('price', '<', $price)->paginate($pagination);
        }
    }
}

?>
