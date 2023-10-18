<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = new File;
        $files = $files->indexFile();

        $files = File::paginate(3);

        // SELECT * FROM `files` ORDERBY $order = 'ASC'
        // Variable utilisée pour obtenir le nom de l'étudiant qui a téléchargé le fichier
        $files2 = File::all()->sortBy("id");

        $count = count($files);

        // Dossier ressources - views - index.blade.php
        return view('file.index', ['files' => $files, 'files2' => $files2, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Dossier ressources - views - create.blade.php
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // la donnée 'file' est en commentaire car sinon aucun document ne peut être uploader
        // même pdf, zip et docx ne sont pas acceptés
        $request->validate([
            'title_fr' => 'required|min:2',
            'title' => 'required|min:2',
            //'file' => 'required|mimes:pdf,zip,docx|max:5120',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        // Je ne réussi pas à obtenir le contenu du fichier
        // $contents = Storage::get($request->file);

        // Utilisation de 'content' pour le contenu du fichier
        Storage::disk('public')->put($request->file, 'content');

        $path = 'app/public/'.$request->file;

        $newPost = File::create([
            'title_fr' => $request->title_fr,
            'title' => $request->title,
            'date' => $request->date,
            'path' => $path,
            'etudiant_id' => Auth::user()->id
        ]);

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('file.index'))->withSuccess(trans('lang.text_file_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $fileId
     * @return \Illuminate\Http\Response
     */
    public function show(File $fileId)
    {
        $user = Auth::user();

        // $file = SELECT * FROM `files` WHERE id = $fileId;
        // Dossier ressources - views - show.blade.php
        return view('file.show', ['file' => $fileId, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $fileId
     * @return \Illuminate\Http\Response
     */
    public function edit(File $fileId)
    {
        // Dossier ressources - views - edit.blade.php
        return view('file.edit', ['file' => $fileId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $fileId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $fileId)
    {
        $request->validate([
            'title_fr' => 'required|min:2',
            'title' => 'required|min:2',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        $fileId->update([
            'title_fr' => $request->title_fr,
            'title' => $request->title,
            'date' => $request->date
        ]);

        // Retour sur le dossier ressources - views - show.blade.php
        return redirect(route('file.show', $fileId))->withSuccess(trans('lang.text_file_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $fileId
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $fileId)
    {
        $fileId->delete();

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('file.index'))->withSuccess(trans('lang.text_data_delete'));
    }

    public function fordownload(File $fileId) {

        return 'abc';

        return Storage::download('your_file_name');
    }
}
