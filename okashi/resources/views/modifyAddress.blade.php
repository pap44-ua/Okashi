@extends('layouts.master')
@section('title', __('titles.modify_address'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="lineHeader">{{ __('headers.modify_address') }}</h2>
            <form action="/addresses/{{ $p->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="street">{{ __('placeholders.street') }}</label>
                    <input type="text" id="street" name="street" class="form-control" value="{{ $p->street }}" placeholder="{{ __('placeholders.street') }}">
                </div>
                <div class="form-group">
                    <label for="city">{{ __('placeholders.city') }}</label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ $p->city }}" placeholder="{{ __('placeholders.city') }}">
                </div>
                <div class="form-group">
                    <label for="state">{{ __('placeholders.state') }}</label>
                    <input type="text" id="state" name="state" class="form-control" value="{{ $p->state }}" placeholder="{{ __('placeholders.state') }}">
                </div>
                <div class="form-group">
                    <label for="postal_code">{{ __('placeholders.postal_code') }}</label>
                    <input type="number" id="postal_code" name="postal_code" class="form-control" value="{{ $p->postal_code }}" placeholder="{{ __('placeholders.postal_code') }}">
                </div>
                <div class="form-group">
                    <label for="country">{{ __('placeholders.country') }}</label>
                    <input type="text" id="country" name="country" class="form-control" value="{{ $p->country }}" placeholder="{{ __('placeholders.country') }}">
                </div>
                <button type="submit" class="btn btn-success">{{ __('buttons.modify_address') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
