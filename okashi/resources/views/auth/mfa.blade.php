<!-- resources/views/mfa_form.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('MFA Verification') }}</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('mfa.verify') }}">
                        @csrf

                        <div class="form-group">
                            <label for="mfa_code">{{ __('MFA Code') }}</label>
                            <input id="mfa_code" type="text" class="form-control @error('mfa_code') is-invalid @enderror" name="mfa_code" value="{{ old('mfa_code') }}" required autofocus>
                            @error('mfa_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Verify Code') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
