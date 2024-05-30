@extends('layouts.master')
@section('title', __('titles.edit_profile'))

@section('content')
<form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}">
    <div class="ring">
        <i style="--clr:#76b5a0;"></i>
        <i style="--clr:#ff7575;"></i>
        <i style="--clr:#fffdd1;"></i>
        <div class="login">
            <h2>{{ __('headers.edit_profile') }} - {{ $user->username }}</h2>
            
                @csrf
                @method('PUT')
                <!-- Campo para el correo electrónico -->
                <div class="inputBx">
                    <label for="username">{{ __('labels.username') }}</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
                    @error('username')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <!-- Campo para la contraseña -->
                <div class="inputBx">
                    <label for="password">{{ __('labels.password') }}</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div >
                <!-- Campo para confirmar la contraseña -->
                <div class="inputBx">
                    <label for="password_confirmation">{{ __('labels.confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit">{{ __('buttons.save_changes') }}</button>
            

        </div>
    </div>
</form>
@endsection
