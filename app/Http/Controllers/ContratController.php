<?php

namespace App\Http\Controllers;

use App\Models\Contrats;
use App\Models\Voiture;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratController extends Controller
{
    public function index(){
        $contrats = Contrats::with('voiture', 'client', 'user')->get();

        return $contrats;
    }

    public function getVoituresDispo(Request $request){
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $voitureDsipo = Voiture::whereNotIn('id', function($query) {
            $query->select('id_voiture')
                  ->from('contrats');
        })
        ->select('voitures.*')
        ->union(DB::table('voitures')
            ->join('contrats', 'voitures.id', '=', 'contrats.id_voiture')
            ->where('contrats.date_debut', '<', $date_debut)
            ->select('voitures.*'))
        ->get();

        return $voitureDsipo;
    }

    public function create(Request $request){
        $contrat = new Contrats();

        $contrat->date_debut = $request->date_debut;
        $contrat->date_fin = $request->date_fin;
        $contrat->id_voiture = $request->id_voiture;
        $contrat->id_client = $request->id_client;
        $contrat->prix_uni = $request->prix;
        $contrat->id_user = $request->id_user;

        $joursMois = $request->joursMois;

        // Calculer le prix total en fonction du nombre de jours
        $date_debut = new DateTime($request->date_debut);
        $date_fin = new DateTime($request->date_fin);
        $diff = $date_debut->diff($date_fin);
        $nombre_jours = $diff->days;
        $prix_total = $nombre_jours * $request->prix;

        $contrat->prix_total = $prix_total;

        $contrat->save();
    }

    public function delete($id){
        $contrat = Contrats::find($id);
        $contrat->delete();


    }

    public function getNombreContrats(){
        
        $result = DB::table('contrats')
                ->select(DB::raw('DATE(created_at) as date_contrat'), DB::raw('COUNT(id) as nombre_de_contrats'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy(DB::raw('DATE(created_at)'))
                ->get();

        return $result;
    }
}
