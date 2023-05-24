<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->view('admin.products', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:products',
            'first_price' => 'required',
            'second_price' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'type_taxes' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->first_price = $request->first_price;
        $product->second_price = $request->second_price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->type_taxes = $request->type_taxes;
        $product->save();

        return response()->json(['message' => 'Producto creado correctamente.']);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente.']);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return response()->view('admin.edits.product-edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->first_price = $request->first_price;
        $product->second_price = $request->second_price;
        $product->quantity = $request->quantity;
        $product->discount = $request->discount;
        $product->type_taxes = $request->type_taxes;
        $product->save();

        return response()->json(['message' => 'Producto actualizado correctamente.']);
    }

    public function search(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $autocomplate = Product::orderby('name', 'asc')->select('*')->limit(5)->get();
        } else {
            $autocomplate = Product::orderby('name', 'asc')->select('*')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($autocomplate as $autocomplate) {
            $response[] = array("value" => $autocomplate->id, "label" => $autocomplate->name);
        }

        echo json_encode($response);
        exit;
    }

    public function getItem(Request $request)
    {
        $item = Product::find($request->item);

        return response()->json(['message' => 'Buscando...', 'data' => $item, 'quantity'=>$request->quantity]);
    }
}
