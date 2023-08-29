<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrats extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = "contrats";
    protected $fillable = [
        "prix_uni",
        "prix_total",
        "date_debut",
        "date_fin"
    ];

        // Relation avec le modèle "User"
        public function user()
        {
            return $this->belongsTo(User::class, 'id_user');
        }

        // Relation avec le modèle "Voiture"
        public function voiture()
        {
            return $this->belongsTo(Voiture::class, 'id_voiture');
        }

        // Relation avec le modèle "Client"
        public function client()
        {
            return $this->belongsTo(Clients::class, 'id_client');
        }
}
