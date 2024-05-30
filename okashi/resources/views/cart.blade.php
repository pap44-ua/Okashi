@extends('layouts.master')
@section('title', __('titles.cart'))
@section('content')
<div class="container my-4">
    <div class="row">
        @foreach ($products as $p)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <a href="{{ '/product/' . $p->id }}">
                    <img src="{{ URL::asset('storage/products/' . $p->image) }}" class="card-img-top" alt="{{ $p->name }}">
                </a>
                <div class="card-body">
                    <a href="{{ '/product/' . $p->id }}" class="text-decoration-none">
                        <h5 class="card-title">{{ $p->name }}</h5>
                    </a>
                    <p class="card-text">{{ $p->price }} €</p>
                    <form action="{{ '/shoppingCart/' . $id . '/modify' }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $p->id }}" />
                        <input type="number" class="form-control" name="quantity" min="1" max="100" value="{{ $quantities[$p->id] }}" />
                        <button type="submit" class="btn btn-success mt-2">{{ __('buttons.modify') }}</button>
                    </form>
                    <form action="{{ '/shoppingCart/' . $id . '/delete' }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="product_id" value="{{ $p->id }}" />
                        <button type="submit" class="btn btn-danger mt-2">{{ __('buttons.delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row justify-content-center align-items-center mt-4">
        <div class="col-auto">
            <span class="font-weight-bold display-4">{{ __('labels.total') }}: {{ $price }}€</span>
        </div>
    </div>
    @auth
    <div class="row justify-content-between mt-4">
        <div class="col-auto">
            <form action="{{ route('ShoppingCart.delete', ['id' => $id]) }}" method="POST" class="mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('buttons.delete') }}</button>
            </form>
        </div>
        <div class="col-auto">
            <form action="{{ route('checkout') }}" method="GET">
                @csrf
                <input type="hidden" name="cart_id" value="{{ $id }}">
                <button type="submit" class="btn btn-primary">{{ __('buttons.buy_now') }}</button>
            </form>
        </div>
    </div>
    @endauth
    @guest
    <div class="row justify-content-center mt-4">
        <div class="col-auto">
            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('buttons.login_to_checkout') }}</a>
        </div>
    </div>
    @endguest
</div>
@endsection
