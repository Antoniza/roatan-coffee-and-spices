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
        $validator = $request->validate([
            'full_name' => 'required',
            'rtn' => 'required|min:14|unique:clients',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $client = new Client();
        $client -> full_name = $request -> full_name;
        $client -> rtn = $request -> rtn;
        $client -> email = $request -> email;
        $client -> phone = $request -> phone;
        $client -> save();

        return response()->json(['message'=>'Cliente creado correctamente.']);
    }

    public function delete($id){
        $client = Client::find($id);
        $client->delete();

        return response()->json(['message'=>'Cliente eliminado correctamente.']);
    }

    public function edit($id){
        $client = Client::find($id);

        return response()->view('admin.edits.client-edit', ['client' => $client]);
    }

    public function update(Request $request, $id){
        $client = Client::find($id);
        $client -> full_name = $request -> full_name;
        $client -> rtn = $request -> rtn;
        $client -> email = $request -> email;
        $client -> phone = $request -> phone;

        $client->save();

        return response()->json(['message'=>'Cliente actualizado correctamente.']);
    }

    public function search(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $autocomplate = Client::orderby('full_name', 'asc')->select('*')->limit(5)->get();
        } else {
            $autocomplate = Client::orderby('full_name', 'asc')->select('*')->where('rtn', 'like', '%' . $search . '%')->orWhere('full_name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($autocomplate as $autocomplate) {
            $response[] = array("value" => $autocomplate->id, "label" => $autocomplate->full_name);
        }

        echo json_encode($response);
        exit;
    }

}
