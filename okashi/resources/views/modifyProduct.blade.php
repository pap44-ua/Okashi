@extends('layouts.master')
@section('title', __('titles.modify_product'))
@section('content')
<div class="container my-5">
    <div class="lineHeader h4 mb-4">{{ __('headers.modify_product') }}</div>
    <form action="/products/{{ $p->id }}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('placeholders.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('placeholders.name') }}" value="{{ $p->name }}" required>
            <div class="invalid-feedback">
                {{ __('placeholders.name') }} es obligatorio.
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('placeholders.description') }}</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('placeholders.description') }}" value="{{ $p->description }}" required>
            <div class="invalid-feedback">
                {{ __('placeholders.description') }} es obligatorio.
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('placeholders.price') }}</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="{{ __('placeholders.price') }}" value="{{ $p->price }}" required>
            <div class="invalid-feedback">
                {{ __('placeholders.price') }} es obligatorio.
            </div>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">{{ __('placeholders.brand') }}</label>
            <input type="text" class="form-control" id="brand" name="brand" placeholder="{{ __('placeholders.brand') }}" value="{{ $p->brand }}" required>
            <div class="invalid-feedback">
                {{ __('placeholders.brand') }} es obligatorio.
            </div>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">{{ __('placeholders.stock') }}</label>
            <input type="number" class="form-control" id="stock" name="stock" placeholder="{{ __('placeholders.stock') }}" value="{{ $p->stock }}" required>
            <div class="invalid-feedback">
                {{ __('placeholders.stock') }} es obligatorio.
            </div>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('labels.image') }}</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="{{ __('placeholders.image') }}">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('buttons.modify_product') }}</button>
    </form>
</div>

<script>
    // Bootstrap validation
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
