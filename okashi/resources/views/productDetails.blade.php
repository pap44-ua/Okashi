@extends('layouts.master')
@section('title', __('titles.product_details'))
@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ URL::asset('storage/products/' . $p->image) }}" class="img-fluid" alt="{{ $p->name }}">
        </div>
        <div class="col-md-4">
            <h1>{{ $p->name }}</h1>
            <p>{{ $p->description }}</p>
            <h3>{{ number_format($p->price, 2, ',', '.') }} €</h3>
            @auth
            <form action="/shoppingCart/add" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $p->id }}" />
                <div class="form-group">
                    <label for="quantity">{{ __('labels.pd_quantity') }}</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="100" value="1">
                </div>
                <button type="submit" class="btn btn-success">{{ __('buttons.add_to_cart') }}</button>
            </form>
            @endauth
            @guest
            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('buttons.add_to_cart') }}</a>
            @endguest
        </div>
    </div>
    <hr>
    <div class="lineHeader my-4">{{ __('headers.suggested_products') }}</div>
    <div class="row">
        @foreach ($recommended as $r)
            <div class="col-md-2 col-sm-4 mb-3">
                <div class="card h-100">
                    <a href="{{ '/product/' . $r->id }}">
                        <img class="card-img-top" src="{{ URL::asset('storage/products/' . $r->image) }}" alt="{{ $r->name }}">
                    </a>
                    <div class="card-body text-center">
                        <a href="{{ '/product/' . $r->id }}">
                            <h5 class="card-title">{{ $r->name }}</h5>
                        </a>
                        <p class="card-text">{{ number_format($r->price, 2, ',', '.') }} €</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
