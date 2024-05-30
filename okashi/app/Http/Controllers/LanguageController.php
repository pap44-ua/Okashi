<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageController extends Controller
{
    public function change($locale)
    {
        if (array_key_exists($locale, LaravelLocalization::getSupportedLocales())) {
            LaravelLocalization::setLocale($locale);
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
