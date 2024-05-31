<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }
    public function store(Request $request)
    {
        $request->validate([
           
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        return Product::create($request->all());
    }

    public function show( $id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $product->update($request->all());
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
