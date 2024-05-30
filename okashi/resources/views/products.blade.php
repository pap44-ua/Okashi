@extends('layouts.master')
@section('title', __('titles.products'))
@section('content')
<div class="container">
    @php $productsCount = $products->count(); @endphp
    @for ($i = 0; $i < $productsCount; $i+=5)
    <div class="row justify-content-center"> <!-- Añadida la clase justify-content-center -->
        @foreach ($products->slice($i, 5) as $product)
            <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
                <div class="card h-100">
                    <a href="{{ '/product/' . $product->id }}">
                        <img class="card-img-top img-thumbnail" src="{{ URL::asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <a href="{{ '/product/' . $product->id }}">
                            <h5 class="card-title">{{ $product->name }}</h5>
                        </a>
                        <h6>{{ number_format($product->price, 2, ',', '.') }} €</h6>
                        <p class="card-text small">{{ __('labels.stock') }}: {{ $product->stock }}</p>
                    </div>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="card-footer">
                            <form action="{{ route('Product.delete', $product->id) }}" method="POST" style="margin: auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('Product.modify', $product->id) }}" method="get" style="margin: auto">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endfor

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
