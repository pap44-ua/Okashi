@extends('layouts.master')
@section('title', __('titles.confirm_payment'))
@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('headers.confirm_payment') }}</h5>
                    <p class="card-text">{{ __('labels.total') }}: {{ $total }}€</p>
                    @auth
                    <form method="POST" action="{{ route('buyCart', ['id' => $cart_id]) }}">
                        @csrf
                        <input type="hidden" name="card_id" value="{{ $card_id }}">
                        <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                        <input type="hidden" name="total" value="{{ $total }}">
                        <button type="submit" class="btn btn-success">{{ __('buttons.confirm_payment') }}</button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">{{ __('buttons.login_to_confirm') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
