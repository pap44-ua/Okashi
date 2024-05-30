@extends('layouts.master')
@section('title', 'Okashi')
@section('content')

<!-- Carousel Section -->
<section id="carouselContainer" class="mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($carousel as $index => $c)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ URL::asset('storage/'. $c) }}" class="d-block w-100" alt="Slide {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Header -->
<div class="lineHeader">{{ __('headers.under_three_euros') }}</div>

<!-- Recommended Products Section -->
<div class="container">
    <div class="row fancyListing">
        @foreach ($recommended as $r)
        <div class="col-md-2 col-sm-5 mb-3">
            <div class="card h-100">
                <a href="{{ '/product/' . $r->id }}">
                    <img src="{{ URL::asset('storage/products/' . $r->image) }}" class="card-img-top" alt="{{ $r->name }}">
                </a>
                <div class="card-body text-center">
                    <a href="{{ '/product/' . $r->id }}" class="text-decoration-none">
                        <h5 class="card-title">{{ $r->name }}</h5>
                    </a>
                    <p class="card-text">{{ $r->price }}€</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize the carousel
        $('.carousel').carousel();
    });
</script>
@endsection
