<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index($locale) {

        // Va regarder la langue enreristrée
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
