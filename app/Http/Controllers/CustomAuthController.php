<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// Pour encrypter le mot de passe
use Illuminate\Support\Facades\Hash;
// Pour authentifier la connection
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // email|unique:users = vérifie qu'il n'y a pas un autre email pareille
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20'
        ]);

        $user = new User;
        $user->fill($request->all());

        // Encrypter le mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('login'))->withSuccess(trans('lang.text_registered_user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function authentication(Request $request) {
        // Vérifie que l'utilisateur existe
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        // credentials = informations d'identification
        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                        // trans = quel est le dossier de langue, qui est 'password'
                        // resources\lang\validation.php
                        ->withErrors(trans('auth.password'))
                        ->withInput();
        endif;

        // Créer la session de login
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        Auth::login($user);

        $userId = Auth::user()->id;

        return redirect()->intended(route('etudiant.show', [$userId]));
    }

    /*public function userList(){
        $users = User::Select()
                    ->paginate(5);

        return view('auth.user-list', ['users' => $users]);
    }*/

    public function logout() {
        Auth::logout();

        return redirect(route('login'));
    }
}
