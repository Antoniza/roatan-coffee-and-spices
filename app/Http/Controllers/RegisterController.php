<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => ['required','min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['required', 'min:8', 'string', 'max:20']
        ]);

        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = Hash::make($request -> password);
        $user -> phone = $request -> phone;
        $user -> rank = 1;
        $user->save();

        return response()->json(['message'=>'Usuario creado con exito.', 'data'=>['name'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone]]);
     }
}
