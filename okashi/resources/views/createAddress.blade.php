@extends('layouts.master')
@section('title', __('titles.create_address'))
@section('content')
<div class="lineHeader">{{ __('headers.create_address') }}</div>
<form action="{{ route('admin.address.add') }}" class="crearForm" method="post">
    @csrf
    <div class="form-group">
        <label for="street">{{ __('placeholders.street') }}</label>
        <input type="text" name="street" class="form-control" id="street" placeholder="{{ __('placeholders.street') }}" required>
    </div>
    <div class="form-group">
        <label for="city">{{ __('placeholders.city') }}</label>
        <input type="text" name="city" class="form-control" id="city" placeholder="{{ __('placeholders.city') }}" required>
    </div>
    <div class="form-group">
        <label for="state">{{ __('placeholders.state') }}</label>
        <input type="text" name="state" class="form-control" id="state" placeholder="{{ __('placeholders.state') }}" required>
    </div>
    <div class="form-group">
        <label for="postal_code">{{ __('placeholders.postal_code') }}</label>
        <input type="number" name="postal_code" class="form-control" id="postal_code" placeholder="{{ __('placeholders.postal_code') }}" required>
    </div>
    <div class="form-group">
        <label for="country">{{ __('placeholders.country') }}</label>
        <input type="text" name="country" class="form-control" id="country" placeholder="{{ __('placeholders.country') }}" required>
    </div>
    <div class="form-group">
        <label for="user_id">{{ __('labels.select_user') }}</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">{{ __('buttons.create_address') }}</button>
</form>
@endsection
