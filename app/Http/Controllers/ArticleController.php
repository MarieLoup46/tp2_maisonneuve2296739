<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = new Article;
        $articles = $articles->indexArticle();

        // Dossier ressources - views - index.blade.php
        return view('article.index', ['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Dossier ressources - views - create.blade.php
        return view('article.create');
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
            'title_fr' => 'required|min:2',
            'title' => 'required|min:2',
            'content_fr' => 'required|min:6|max:5000',
            'content' => 'required|min:6|max:5000',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        $newPost = Article::create([
            'title_fr' => $request->title_fr,
            'title' => $request->title,
            'content_fr' => $request->content_fr,
            'content' => $request->content,
            'date' => $request->date,
            'etudiant_id' => Auth::user()->id
        ]);

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('article.index'))->withSuccess(trans('lang.text_article_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $articleId
     * @return \Illuminate\Http\Response
     */
    public function show($articleId)
    {
        $user = Auth::user();
        $article = new Article;
        $article = $article->selectArticle($articleId);

        // $article = SELECT * FROM `articles` WHERE id = $articleId;
        // Dossier ressources - views - show.blade.php
        return view('article.show', ['article' => $article, 'user' => $user]);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $articleId
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $articleId)
    {
        // Dossier ressources - views - edit.blade.php
        return view('article.edit', ['article' => $articleId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $articleId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $articleId)
    {
        $request->validate([
            'title_fr' => 'required|min:2',
            'title' => 'required|min:2',
            'content_fr' => 'required|min:6|max:5000',
            'content' => 'required|min:6|max:5000',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        $articleId->update([
            'title_fr' => $request->title_fr,
            'title' => $request->title,
            'content_fr' => $request->content_fr,
            'content' => $request->content,
            'date' => $request->date
        ]);

        // Retour sur le dossier ressources - views - show.blade.php
        return redirect(route('article.show', $articleId))->withSuccess(trans('lang.text_data_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $articleId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $articleId)
    {

        //return $articleId;
        $articleId->delete();

        // Retour sur le dossier ressources - views - index.blade.php
        return redirect(route('article.index'))->withSuccess(trans('lang.text_data_delete'));
    }
}
