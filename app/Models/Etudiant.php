<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'adresse',
        'phone',
        'email',
        'date_naissance',
        'ville_id'
    ];

    public function etudiantVille() {
        // 'App\Models\Ville' = position de la table
        // 'id' = clé primaire et 'ville_id' = clé étrangère
        return $this->hasOne('App\Models\Ville', 'id', 'ville_id');
    }
}
