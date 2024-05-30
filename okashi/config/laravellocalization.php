<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | Contains an array with the locales which the application should support.
    |
    */
    'supportedLocales' => [
        'es' => [
            'name' => 'Spanish',
            'script' => 'Latn',
            'native' => 'Español',
            'regional' => 'es_ES'
        ],
        'en' => [
            'name' => 'English',
            'script' => 'Latn',
            'native' => 'English',
            'regional' => 'en_GB'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Use Accept-Language Header
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should take the Accept-Language header into
    | account when trying to determine the default locale.
    |
    */
    'useAcceptLanguageHeader' => true,

    /*
    |--------------------------------------------------------------------------
    | Hide Default Locale in URL
    |--------------------------------------------------------------------------
    |
    | Whether or not the default locale should be hidden in the URL.
    |
    */
    'hideDefaultLocaleInURL' => false,

    /*
    |--------------------------------------------------------------------------
    | Set Locale from URL
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should try to determine the locale from the URL.
    |
    */
    'setLocaleFromURL' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | The default locale used by the translation system when no other locale is
    | specified or detected.
    |
    */
    'defaultLocale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Locales Mapping
    |--------------------------------------------------------------------------
    |
    | Contains an array of locales that should be redirected to other locales
    | following the locale mapping.
    |
    */
    'localesMapping' => [],

    /*
    |--------------------------------------------------------------------------
    | Locales Lookup
    |--------------------------------------------------------------------------
    |
    | If this value is set to true, the locale detection will take into account
    | the locales that are only present in the list of supported locales.
    |
    */
    'localesLookup' => false,

    /*
    |--------------------------------------------------------------------------
    | Locale Separator
    |--------------------------------------------------------------------------
    |
    | The locale separator is used to separate the locale from the URL prefix.
    |
    */
    'localeSeparator' => '-',

    /*
    |--------------------------------------------------------------------------
    | Locale Detection Middleware
    |--------------------------------------------------------------------------
    |
    | The middleware used to detect the locale in the URL and set the application's
    | locale accordingly.
    |
    */
    'middleware' => [
        'localize' => Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeCookieRedirect' => Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
        'localeViewPath' => Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirection Status Code
    |--------------------------------------------------------------------------
    |
    | The HTTP status code used for redirections by the package.
    |
    */
    'redirectionStatusCode' => 302,

    /*
    |--------------------------------------------------------------------------
    | Use Session Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should store the locale in the session.
    |
    */
    'useSessionLocale' => true,

    /*
    |--------------------------------------------------------------------------
    | Use Cookie Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should store the locale in a cookie.
    |
    */
    'useCookieLocale' => false,

    /*
    |--------------------------------------------------------------------------
    | Use Accept-Language Header Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should use the Accept-Language header locale.
    |
    */
    'useAcceptLanguageHeader' => true,

    /*
    |--------------------------------------------------------------------------
    | Use Fallback Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should use the fallback locale.
    |
    */
    'useFallbackLocale' => false,

    /*
    |--------------------------------------------------------------------------
    | Use Path Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should use the locale in the path.
    |
    */
    'usePathLocale' => true,

    /*
    |--------------------------------------------------------------------------
    | Use Query Locale
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should use the locale in the query string.
    |
    */
    'useQueryLocale' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Path
    |--------------------------------------------------------------------------
    |
    | The default path used for locale redirections.
    |
    */
    'defaultPath' => null,

    /*
    |--------------------------------------------------------------------------
    | Use SSL
    |--------------------------------------------------------------------------
    |
    | Whether or not the package should use SSL.
    |
    */
    'useSSL' => false,

];
