@extends('layouts.master')
@section('title', __('titles.create_user'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="lineHeader">{{ __('headers.create_user') }}</h2>
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="username">{{ __('placeholders.username') }}</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="{{ __('placeholders.username') }}" required>
                </div>
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="email" id="email_address" name="email_address" class="form-control" placeholder="user@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="passwd">{{ __('placeholders.password') }}</label>
                    <input type="password" id="passwd" name="passwd" class="form-control" placeholder="{{ __('placeholders.password') }}" required>
                </div>
                <div class="form-group">
                    <label for="address">{{ __('placeholders.address_id') }}</label>
                    <input type="number" id="address" name="address" class="form-control" placeholder="{{ __('placeholders.address_id') }}" required>
                </div>
                <button type="submit" class="btn btn-success">{{ __('buttons.create_user') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
