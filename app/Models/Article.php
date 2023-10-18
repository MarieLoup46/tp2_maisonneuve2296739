<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_fr',
        'title',
        'content_fr',
        'content',
        'date',
        'etudiant_id'
    ];

    public function articleEtudiant() {
        // 'App\Models\Etudiant' = position de la table
        // 'id' = clé primaire et 'etudiant_id' = clé étrangère
        return $this->hasOne('App\Models\Etudiant', 'id', 'etudiant_id');
    }

    static public function selectArticle($id, $order = 'ASC') {

        $lang = null;        
        if(session()->has('locale') && session()->get('locale') == 'fr') {
             $lang = '_fr';
        }

        return self::select('id', 'content', 'date', 'etudiant_id', 
            DB::raw("(case when title$lang is null then title else title$lang end) as title, (case when content$lang is null then content else content$lang end) as content"))
            ->where("id", $id)
            ->orderBy('title', $order)
            ->first();
    }

    static public function indexArticle($order = 'ASC') {

        $lang = null;        
        if(session()->has('locale') && session()->get('locale') == 'fr') {
             $lang = '_fr';
        }

        return self::select('id', 
            DB::raw("(case when title$lang is null then title else title$lang end) as title"))
            ->orderBy('title', $order)
            ->get();
    }
}
