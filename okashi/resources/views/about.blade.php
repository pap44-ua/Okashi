@extends('layouts.master')
@section('title', __('titles.about'))
@section('content')
<div class="container my-4">
    <div class="text-center">
        <p class="font-weight-bold">{{ __('messages.welcome') }}</p>
        <p>{{ __('messages.about_us') }}</p>
        <p class="font-weight-bold">{{ __('messages.contact_us') }}</p>
    </div>

    @auth
    <form action="{{ url('/about') }}" id="contactForm" method="post" class="mb-4 d-flex flex-column align-items-center">
        @csrf
        <div class="form-group w-75">
            <textarea name="comment" class="form-control" rows="5" placeholder="{{ __('placeholders.write_here') }}"></textarea>
        </div>
        <button type="submit" class="btn btn-success">{{ __('buttons.send') }}</button>
    </form>
    @endauth
    @guest
        <div style="display:flex; justify-content: center; width: 100%; margin-bottom: 2rem;">
            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('links.login') }}</a>
        </div>
    @endguest

    <div id="mapContainer" class="mx-auto" style="width: 100%; max-width: 800px; height: 400px;">
        <div id="map" style="height: 100%;"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([38.38193544451862, -0.5081740478882859], 50);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([38.38193544451862, -0.5081740478882859]).addTo(map)
        .bindPopup('Aqui puedes encontrarnos')
        .openPopup();
</script>
@endsection
