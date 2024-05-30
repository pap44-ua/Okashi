<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>


    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <!--<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="" id="theme-link">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <style>
        /* Estilos para el toggle switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #121212;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        /* Cambiar color del menú a rosa */
        .navbar-light {
            background-color: #ff7575!important;
        }

        /* Cambiar color de los enlaces a blanco */
        .navbar-light .navbar-nav .nav-link {
            color: #FFFDD1 !important;
        }

        /* Cambiar color del botón de búsqueda a blanco */
        .navbar-light .navbar-form .btn {
            color: #ff7575 !important;
        }
    </style>

    <!-- Leaflet CSS (solo si se necesita en la vista actual) -->
    @yield('csss')
</head>
<body>
    @include('navBar')
    <div id="content">
        @yield('content')
    </div>
    <div style="height: 3rem; width: 100%"></div>

    @include('layouts.footer') <!-- Incluir el footer -->
    

    <!-- Leaflet JS (solo si se necesita en la vista actual) -->
    @yield('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Establecer tema inicial basado en localStorage
        document.addEventListener("DOMContentLoaded", function() {
            let theme = localStorage.getItem('theme') || 'light';
            let themeLink = document.getElementById('theme-link');
            let darkModeToggle = document.getElementById('darkModeToggle');
            
            if (theme === 'dark') {
                themeLink.setAttribute('href', "{{ asset('css/dark.css') }}");
                darkModeToggle.checked = true;
            } else {
                themeLink.setAttribute('href', "");
                darkModeToggle.checked = false;
            }
        });

        // Función para alternar entre modo claro y oscuro
        function toggleDarkMode() {
            let themeLink = document.getElementById('theme-link');
            let darkModeToggle = document.getElementById('darkModeToggle');
            
            if (darkModeToggle.checked) {
                themeLink.setAttribute('href', "{{ asset('css/dark.css') }}");
                localStorage.setItem('theme', 'dark');
            } else {
                themeLink.setAttribute('href', "");
                localStorage.setItem('theme', 'light');
            }
        }
    </script>
</body>
</html>
