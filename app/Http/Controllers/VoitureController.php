<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index(){
        $voitures = Voiture::all();

        return $voitures;
    }

    public function create(Request $request){
        $voiture = new Voiture();

        $voiture->marque = $request->input("marque");
        $voiture->immatriculation = $request->input("immatriculation");
        $voiture->number_passengers = $request->input("passagers");
        $voiture->color = $request->input("color");
        $voiture->bodyType = $request->input("BodyType");
        $voiture->kilometrage = $request->input("kilometrage");

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $name);

        $voiture->file = $name;

        $voiture->save();

    }

    public function delete($id){
        $voiture = Voiture::find($id);

        $voiture->delete();

        return response()->json();

    }

    public function getVoiture($id){
        $voiture = Voiture::find($id);

        return $voiture;
    }

    public function edit(Request $request , $id){
        $voiture = Voiture::find($id);

        $voiture->marque = $request->input('marque');
        $voiture->immatriculation = $request->input(('immatriculation'));
        $voiture->number_passengers = $request->input("passagers");
        $voiture->color = $request->input("color");
        $voiture->kilometrage = $request->input("kilometrage");
        $voiture->bodyType = $request->input('BodyType');

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $name);

        $voiture->file = $name;

        $voiture->update();
    }
}
