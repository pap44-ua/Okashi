@extends('layouts.master')
@section('title', __('titles.modify_user'))
@section('content')
<div class="lineHeader">{{ __('headers.modify_user') }}</div>
<form action="/users/{{ $p->id }}" class="crearForm" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="username" placeholder="{{ __('placeholders.username') }}" value="{{ $p->username }}">
    <input type="email" name="email_address" placeholder="user@gmail.com" value="{{ $p->email_address }}">
    <input type="text" name="passwd" placeholder="{{ __('placeholders.password') }}">
    <div>
        <label for="is_admin">{{ __('labels.is_admin') }}</label>
        <select name="is_admin" id="is_admin">
            <option value="0">{{ __('labels.no') }}</option>
            @if ($p->is_admin)
            <option value="1" selected>{{ __('labels.yes') }}</option>
            @else
            <option value="1">{{ __('labels.yes') }}</option>
            @endif
        </select>
    </div>
    <div>
        <label for="is_confirmed">{{ __('labels.is_confirmed') }}</label>
        <select name="is_confirmed" id="is_confirmed">
            <option value="0">{{ __('labels.no') }}</option>
            @if ($p->confirmed)
            <option value="1" selected>{{ __('labels.yes') }}</option>
            @else
            <option value="1">{{ __('labels.yes') }}</option>
            @endif
        </select>
    </div>
    <input type="submit" class="greenButton" value="{{ __('buttons.modify_user') }}">
</form>
@endsection
