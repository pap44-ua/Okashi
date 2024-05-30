@extends('layouts.master')
@section('title', __('titles.checkout'))
@section('content')
<div class="container my-4">
    <div class="lineHeader">{{ __('headers.select_card') }}</div>
    @foreach ($cards as $card)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span>**** **** **** {{ substr($card->card_number, -4) }}</span>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('processPayment') }}" method="POST" class="mb-2">
                        @csrf
                        <input type="hidden" name="card_id" value="{{ $card->id }}">
                        <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="cvv" placeholder="CVV" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">{{ __('buttons.use_this_card') }}</button>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('Card.delete', $card->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('buttons.delete_this_card') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
