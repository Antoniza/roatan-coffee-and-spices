<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        $clients = Client::all();
        return response()->view('admin.clients', ['clients' => $clients]);
    }

    public function store(Request $request){
        $request->validate([
            'full_name' => ['required', 'min:37'],
            'dni' => ['required', 'min:14'],
            'email' => ['required'],
            'phone' => ['required']
        ]);


        $client = new Client();
        $client -> full_name = $request -> full_name;
        $client -> dni = $request -> dni;
        $client -> email = $request -> email;
        $client -> phone = $request -> phone;
        $client -> save();

        return response()->json(['message'=>'Cliente creado correctamente.']);
    }
}
