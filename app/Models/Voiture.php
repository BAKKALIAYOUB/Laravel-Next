<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;

    protected $table = "voitures";

    protected $fillable = [
        "marque",
        "immatriculation",
        "number_passengers",
        "color",
        "kilometrage",
        "file",
        "bodyType"
    ];


}
