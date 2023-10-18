<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LocalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// En lien avec la fonction index() du controller EtudiantController.php
Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index')->middleware('auth');

// En lien avec la fonction show() du controller EtudiantController.php
// Le get attend un paramètre qui est l'id d'un étudiant et qui provient de l'index
Route::get('/etudiant/{etudiantId}', [EtudiantController::class, 'show'])->name('etudiant.show')->middleware('auth');

// En lien avec la fonction create() du controller EtudiantController.php
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create');

// En lien avec la fonction store() du controller EtudiantController.php
// post - création (insertion)
Route::post('/etudiant-create', [EtudiantController::class, 'store']);

// En lien avec la fonction edit() du controller EtudiantController.php
// Attend en paramètre l'id de l'étudiant
Route::get('/etudiant-edit/{etudiantId}', [EtudiantController::class, 'edit'])->name('etudiant.edit');

// En lien avec la fonction update() du controller EtudiantController.php
Route::put('/etudiant-edit/{etudiantId}', [EtudiantController::class, 'update']);

// En lien avec la fonction destroy() du controller EtudiantController.php
Route::delete('/etudiant-edit/{etudiantId}', [EtudiantController::class, 'destroy'])->name('etudiant.delete');

// En lien avec la fonction index() du controller ArticleController.php
Route::get('/article', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');

// En lien avec la fonction show() du controller ArticleController.php
// Le get attend un paramètre qui est l'id d'un article et qui provient de l'index
Route::get('/article/{articleId}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');

// En lien avec la fonction create() du controller ArticleController.php
Route::get('/article-create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');

// En lien avec la fonction store() du controller ArticleController.php
// post - création (insertion)
Route::post('/article-create', [ArticleController::class, 'store']);

// En lien avec la fonction edit() du controller ArticleController.php
// Attend en paramètre l'id de l'article
Route::get('/article-edit/{articleId}', [ArticleController::class, 'edit'])->name('article.edit');

// En lien avec la fonction update() du controller ArticleController.php
Route::put('/article-edit/{articleId}', [ArticleController::class, 'update']);

// En lien avec la fonction destroy() du controller ArticleController.php
Route::delete('/article-edit/{articleId}', [ArticleController::class, 'destroy'])->name('article.delete');

// En lien avec la fonction index() et authentication() du controller CustomAuthController.php
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication']);

// En lien avec la fonction create() du controller CustomAuthController.php
Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.create');

// En lien avec la fonction store() du controller CustomAuthController.php
Route::post('/registration', [CustomAuthController::class, 'store']);

// En lien avec la fonction logout() du controller CustomAuthController.php
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

// En lien avec la fonction index() du controller FileController.php
Route::get('/file', [FileController::class, 'index'])->name('file.index')->middleware('auth');

// En lien avec la fonction show() du controller FileController.php
// Le get attend un paramètre qui est l'id d'un fichier et qui provient de l'index
Route::get('/file/{fileId}', [FileController::class, 'show'])->name('file.show')->middleware('auth');

// En lien avec la fonction create() du controller FileController.php
Route::get('/file-create', [FileController::class, 'create'])->name('file.create')->middleware('auth');

// En lien avec la fonction store() du controller FileController.php
// post - création (insertion)
Route::post('/file-create', [FileController::class, 'store']);

// En lien avec la fonction edit() du controller FileController.php
// Attend en paramètre l'id du fichier
Route::get('/file-edit/{fileId}', [FileController::class, 'edit'])->name('file.edit');

// En lien avec la fonction update() du controller ArticleController.php
Route::put('/file-edit/{fileId}', [FileController::class, 'update']);

// En lien avec la fonction destroy() du controller ArticleController.php
Route::delete('/file-edit/{fileId}', [FileController::class, 'destroy'])->name('file.delete');

// En lien pour télécharger un fichier
Route::post('download', [FileController::class, 'fordownload'])->name('down');
