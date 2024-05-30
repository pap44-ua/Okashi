@extends('layouts.master')
@section('title', __('titles.register'))
@section('csss')
<link href="{{ URL::asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Formulario de registro -->
    <form method="POST" action="{{ route('register') }}">
        @csrf <!-- Agrega el token CSRF para protección contra ataques CSRF -->
        
        <div class="ring">
            <i style="--clr:#76b5a0;"></i>
            <i style="--clr:#ff7575;"></i>
            <i style="--clr:#fffdd1;"></i>
            <div class="login">
                <h2>{{ __('headers.register') }}</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="inputBx">
                    <input type="text" name="username" placeholder="{{ __('placeholders.name') }}">
                </div>
                <div class="inputBx">
                    <input type="text" name="email_address" placeholder="{{ __('placeholders.email') }}">
                </div>
                <div class="inputBx">
                    <input type="password" name="password" placeholder="{{ __('placeholders.password') }}">
                </div>
                <div class="inputBx">
                    <input type="password" name="password_confirmation" placeholder="{{ __('placeholders.confirm_password') }}">
                </div>
                <div class="inputBx">
                    <input type="submit" value="{{ __('buttons.register') }}">
                </div>
                <div class="links">
                    <a href="">{{ __('links.forget_password') }}</a>
                    <a href="{{ route('login') }}">{{ __('links.login') }}</a>
                    
                </div>
            </div>
        </div>
    </form>
@endsection
