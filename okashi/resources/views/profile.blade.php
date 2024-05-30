@extends('layouts.master')
@section('title', __('titles.profile'))
@section('csss')
<link href="{{ URL::asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="ring">
        <i style="--clr:#76b5a0;"></i>
        <i style="--clr:#ff7575;"></i>
        <i style="--clr:#fffdd1;"></i>
        <div class="login">
            <h2>{{ __('messages.welcome_user') }} {{ $user->username }} {{ __('messages.to_your_profile') }}</h2>
            <div class="profile-info">
                <p>{{ __('labels.username') }}: {{ $user->username }}</p>
                <p>{{ __('labels.email') }}: {{ $user->email_address }}</p>
                <!-- Add any other profile information you want to display -->
            </div>
            <div class="links">
                <a href="{{ route('profile.edit', ['id' => $user->id]) }}">{{ __('links.edit_profile') }}</a>
                <a href="{{ route('Card.create') }}">{{ __('links.add_payment') }}</a>
                <a href="/logout">{{ __('links.logout') }}</a>
            </div>

            @if (Auth::user()->mfa_enabled)
                <form method="POST" action="{{ route('profile.disable-mfa') }}">
                    @csrf
                    <button type="submit">Deshabilitar MFA</button>
                </form>
            @else
                <form method="POST" action="{{ route('profile.enable-mfa') }}">
                    @csrf
                    <button type="submit">Habilitar MFA</button>
                </form>
            @endif

            @if (session('status'))
                <p>{{ session('status') }}</p>
            @endif

        </div>
    </div>
@endsection
