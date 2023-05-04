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
}
