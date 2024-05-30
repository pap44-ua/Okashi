@extends('layouts.master')
@section('title', __('titles.login'))
@section('csss')
<link href="{{ URL::asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Formulario de inicio de sesión -->
    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf <!-- Agrega el token CSRF para protección contra ataques CSRF -->
        
        <div class="ring">
            <i style="--clr:#76b5a0;"></i>
            <i style="--clr:#ff7575;"></i>
            <i style="--clr:#fffdd1;"></i>
            <div class="login">
                <h2>{{ __('headers.login') }}</h2>

                <!-- Mensaje de error -->
                @if ($errors->has('loginError'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('loginError') }}
                    </div>
                @endif
                
                <div class="inputBx">
                    <input type="text" name="username" placeholder="{{ __('placeholders.username') }}">
                </div>
                <div class="inputBx">
                    <input type="password" name="password" placeholder="{{ __('placeholders.password') }}">
                </div>
                <div class="inputBx">
                    <input type="submit" value="{{ __('buttons.sign_in') }}">
                </div>
                <div class="links">
                    <a href="#">{{ __('links.forget_password') }}</a>
                    <a href="{{ route('register.show') }}">{{ __('links.signup') }}</a>
                </div>
            </div>
        </div>
    </form>

    <!-- Script para redirigir automáticamente a mfa.blade.php después de enviar el formulario si el usuario tiene MFA habilitado -->
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        
        // Verificar si el usuario tiene MFA habilitado
        @if (Auth::check() && Auth::user()->mfa_enabled)
            window.location.href = "{{ route('mfa.show') }}"; // Redirige a mfa.blade.php
        @else
            this.submit(); // Enviar el formulario normalmente si no hay MFA habilitado
        @endif
    });
</script>

@endsection
