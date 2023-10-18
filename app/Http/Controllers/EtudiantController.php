<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM `etudiants`
        $etudiants = Etudiant::all();

        // Dossier ressources - views - index.blade.php
        return view('etudiant.index', ['etudiants'=>$etudiants]);
    }

    /**
     * Show the form for creating a new etudiant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // SELECT * FROM `villes`
        $villes = Ville::all();

        // Dossier ressources - views - create.blade.php
        return view('etudiant.create', ['villes'=>$villes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:2',
            'adresse' => 'required|min:2',
            'phone' => 'required|min:6|max:25',
            'email' => 'required|email',
            'date_naissance' => 'required|date|date_format:Y-m-d'
        ]);

        // Création d'un mot de passe par défaut
        // L'étudiant pourra le modifier plus tard (cette fonctionnalité n'existe pas pour le moment)
        $password = Hash::make('123456');

        $newUser = User::create([
            'name' => $request->nom,
            'email'=> $request->email,
            'password' => $password
        ]);

        $newPost = Etudiant::create([
            'id' => $newUser->id,
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('etudiant.index'))->withSuccess(trans('lang.text_student_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiantId
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiantId)
    {
        $user = Auth::user();

        // $etudiant = SELECT * FROM `etudiants` WHERE id = $etudiantId;
        // Dossier ressources - views - show.blade.php
        return view('etudiant.show', ['etudiant' => $etudiantId, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiantId
     * @return \Illuminate\Http\Response
     */
    public function edit(Etudiant $etudiantId)
    {
        // SELECT * FROM `villes`
        $villes = Ville::all();
        
        // Dossier ressources - views - edit.blade.php
        return view('etudiant.edit', ['etudiant' => $etudiantId], ['villes'=>$villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiantId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiantId)
    {
        $request->validate([
            'nom' => 'required|min:2',
            'adresse' => 'required|min:2',
            'phone' => 'required|min:6|max:25',
            'email' => 'required|email',
            'date_naissance' => 'required|date|date_format:Y-m-d'
        ]);

        $etudiantId->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);

        // Retour sur le dossier ressources - views - show.blade.php
        return redirect(route('etudiant.show', $etudiantId))->withSuccess(trans('lang.text_data_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiantId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiantId)
    {
        $etudiantId->delete();

        Auth::user()->id->delete();

        Auth::logout();

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('etudiant.index'))->withSuccess(trans('lang.text_data_delete'));
    }
}
