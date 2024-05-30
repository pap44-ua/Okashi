<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Thank you for your purchase!</h1>
    <p>Here is a summary of your order:</p>
    <ul>
        @foreach ($cartItems as $item)
            <li>{{ $item->name }} - {{ $item->pivot->quantity }} x {{ $item->price }}€</li>
        @endforeach
    </ul>
    <p><strong>Total:</strong> {{ $total }}€</p>
</body>
</html>
