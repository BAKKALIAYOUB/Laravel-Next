<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        $client = Clients::all();

        return $client;
    }

    public function create(Request $request){

        $request->validate([
            'phone' => "numeric",
            'cin' => 'regex:/^[A-Z]{1,2}\d+$/',
        ]);

        $client = new Clients();

        $client->fullname = $request->input('fullname');
        $client->cin = $request->input('cin');
        $client->phone = $request->input('phone');
        $client->dateBirth = $request->input('dateBirth');

        $client->save();

    }

    public function delete($id){
        $client = Clients::find($id);
        $client->delete();

        return response()->json();
    }

    public function edit (Request $request , $id){
        $client = Clients::find($id);

        $client->fullname = $request->input("fullname");
        $client->phone = $request->input("phone");
        $client->dateBirth = $request->input("dateBirth");
        $client->cin = $request->input("cin");

        $client->update();
    }

    public function getClient($id){
        $client = Clients::find($id);

        return $client;
    }
}
