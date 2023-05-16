<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->view('admin.products', ['products' => $products]);
    }

    public function store(Request $request){
        $validator = $request->validate([
            'name' => 'required|unique:products',
            'first_price' => 'required',
            'second_price' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'type_taxes' => 'required',
        ]);

        $product = new Product();
        $product -> name = $request -> name;
        $product -> first_price = $request -> first_price;
        $product -> second_price = $request -> second_price;
        $product -> quantity = $request -> quantity;
        $product -> discount = $request -> discount;
        $product -> type_taxes = $request -> type_taxes;
        $product -> save();

        return response()->json(['message'=>'producte creado correctamente.']);
    }

    public function delete($id){
        $client = Product::find($id);
        $client->delete();

        return response()->json(['message'=>'Producto eliminado correctamente.']);
    }
}
