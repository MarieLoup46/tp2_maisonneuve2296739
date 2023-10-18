<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_fr',
        'title',
        'path',
        'date',
        'etudiant_id'
    ];

    public function fileEtudiant() {
        // 'App\Models\Etudiant' = position de la table
        // 'id' = clé primaire et 'etudiant_id' = clé étrangère
        return $this->hasOne('App\Models\Etudiant', 'id', 'etudiant_id');
    }

    static public function indexFile($order = 'ASC') {

        $lang = null;        
        if(session()->has('locale') && session()->get('locale') == 'fr') {
             $lang = '_fr';
        }

        return self::select('id', 
            DB::raw("(case when title$lang is null then title else title$lang end) as title")
        )->orderBy('id', $order)->get();
    }
}
