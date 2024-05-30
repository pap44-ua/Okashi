@extends('layouts.master')
@section('title', __('titles.create_product'))
@section('content')
<div class="container mt-5">
    <div class="lineHeader">{{ __('headers.create_product') }}</div>
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">{{ __('placeholders.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('placeholders.name') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.name')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="description">{{ __('placeholders.description') }}</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('placeholders.description') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.description')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="price">{{ __('placeholders.price') }}</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="{{ __('placeholders.price') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.price')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="brand">{{ __('placeholders.brand') }}</label>
            <input type="text" class="form-control" id="brand" name="brand" placeholder="{{ __('placeholders.brand') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.brand')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="stock">{{ __('placeholders.stock') }}</label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="{{ __('placeholders.stock') }}" required>
            <div class="invalid-feedback">
                {{ __('validation.required', ['attribute' => __('placeholders.stock')]) }}
            </div>
        </div>
        <div class="form-group">
            <label for="image">{{ __('labels.image') }}</label>
            <input type="file" class="form-control-file" id="image" name="image" placeholder="{{ __('placeholders.image') }}">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('buttons.create_product') }}</button>
    </form>
</div>
@endsection
