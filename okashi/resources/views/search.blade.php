@extends('layouts.master')
@section('title', __('titles.search'))
@section('content')

<div class="w-100 bg-light py-3 mb-4"> 
    <div class="container"> 
        <form action="/search" method="get" id="searchForm" class="form-inline"> 
            @csrf
            <div class="form-group mx-sm-3 mb-2"> 
                <label for="name" class="sr-only">{{ __('labels.name') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.name') }}" value="{{ $name }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="price" class="sr-only">{{ __('labels.max_price') }}</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('labels.max_price') }}" value="{{ $price }}">
            </div>
            <button type="submit" class="btn btn-success mb-2">{{ __('buttons.search') }}</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="lineHeader mb-4">{{ __('headers.results') }}</div>

    <div class="row">
        @php
            
            $groupedResults = $results->groupBy('name');
        @endphp

        @foreach ($groupedResults as $name => $group)
            @php
                $product = $group->first();
            @endphp
            <div class="col-md-3 col-sm-4 mb-3">
                <div class="card h-100">
                    <a href="{{ '/product/' . $product->id }}">
                        <img class="card-img-top" src="{{ URL::asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <a href="{{ '/product/' . $product->id }}">
                            <h5 class="card-title">{{ $product->name }}</h5>
                        </a>
                        <p class="card-text">{{ number_format($product->price, 2, ',', '.') }} €</p>
                        <p class="card-text">
                            @if ($product->stock == 0)
                                <span class="text-danger">{{ __('labels.stock') }}: {{ __('labels.out_of_stock') }}</span>
                            @else
                                {{ __('labels.stock') }}: {{ $product->stock }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $results->appends(request()->input())->links() }}
    </div>
</div>
@endsection
