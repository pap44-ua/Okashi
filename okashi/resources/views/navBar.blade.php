<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ URL::asset('img/logo.png') }}" alt="Okashi" width="30" height="30" class="d-inline-block align-top">
            Okashi
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">{{ __('nav_links.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products">{{ __('nav_links.products') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/search">{{ __('nav_links.search') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">{{ __('nav_links.about_us') }}</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="/search" method="get">
                @csrf
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="name">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <div class="navbar-nav ml-auto">
                <!-- Opciones para usuarios autenticados -->
                @auth
                    <a class="nav-link" href="/shoppingCart">
                        <img id="cartButton" src="{{ URL::asset('img/cart.png') }}">
                    </a>
                    <a class="nav-link" href="/profile/{{ Auth::user()->id }}">{{ Auth::user()->username }}</a>
                    <a class="nav-link" href="/logout">{{ __('buttons.logout') }}</a>
                @else
                    <!-- Opciones para usuarios no autenticados -->
                    <a class="nav-link" href="/login">{{ __('buttons.login') }}</a>
                    <a class="nav-link" href="/register">{{ __('buttons.register') }}</a>
                @endauth
                <!-- Opción para el administrador -->
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a class="nav-link" href="/admin">{{ __('buttons.admin') }}</a>
                @endif

                <!-- Toggle de modo noche -->
                <label class="toggle-switch">
                    <input type="checkbox" id="darkModeToggle" onchange="toggleDarkMode()">
                    <span class="slider"></span>
                </label>

                <a class="nav-link" href="{{ route('language.change', ['locale' => 'es']) }}">Español</a>
                <a class="nav-link" href="{{ route('language.change', ['locale' => 'en']) }}">English</a>
            </div>
        </div>
    </div>
</nav>
