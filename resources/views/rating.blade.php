@extends('layouts.app')

@section('content')
<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
<div class="container">

    <h1>Rate Product: {{ $product->title }}</h1>

    <form action="{{ route('user.ratings.store', ['orderId' => $order->id, 'productId' => $product->id]) }}" method="POST">
        @csrf
        <label for="rating">Rate this product:</label>
        <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5" />
            <label for="star5">&#9733;</label>

            <input type="radio" id="star4" name="rating" value="4" />
            <label for="star4">&#9733;</label>

            <input type="radio" id="star3" name="rating" value="3" />
            <label for="star3">&#9733;</label>

            <input type="radio" id="star2" name="rating" value="2" />
            <label for="star2">&#9733;</label>

            <input type="radio" id="star1" name="rating" value="1" />
            <label for="star1">&#9733;</label>
        </div>

        <button type="submit" class="rate-button">Submit Rating</button>
    </form>
</div>
@endsection


<style>
    .star-rating {
    direction: rtl;
    display: inline-block;
    font-size: 30px;
}

.star-rating input[type="radio"] {
    display: none;
}

.star-rating label {
    color: #ccc;
    cursor: pointer;
}

.star-rating input[type="radio"]:checked ~ label {
    color: gold;
}

.star-rating input[type="radio"]:checked ~ label:hover {
    color: gold;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}
</style>