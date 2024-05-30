<?php

namespace App\Http\Middleware;

use Closure;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            LaravelLocalization::setLocale(session()->get('locale'));
        } else {
            // Establece un idioma por defecto si no se ha seleccionado ninguno
            $defaultLocale = 'es';
            LaravelLocalization::setLocale($defaultLocale);
            session()->put('locale', $defaultLocale);
        }

        return $next($request);
    }
}
