@extends('layouts.master')
@section('title', __('titles.add_payment_method'))
@section('content')
<div class="container mt-5">
    <div class="lineHeader">{{ __('headers.add_payment_method') }}</div>
    <form action="{{ route('Card.store') }}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="card_name">{{ __('placeholders.card_name') }}</label>
            <input type="text" class="form-control" id="card_name" name="card_name" placeholder="{{ __('placeholders.card_name') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.card_name')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="card_number">{{ __('placeholders.card_number') }}</label>
            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="{{ __('placeholders.card_number') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.card_number')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => 'CVV']) }}
            </div>
        </div>
        <div class="form-group">
            <label for="expiry_date">{{ __('placeholders.expiry_date') }}</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.expiry_date')]) }}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('buttons.add_card') }}</button>
    </form>
</div>
@endsection
