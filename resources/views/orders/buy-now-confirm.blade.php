@extends('layouts.app')

@section('content')
<div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Success Notification -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Notification -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
<div class="container" style="max-width: 800px; margin-top: 30px; font-family: Arial, sans-serif;">
    <div class="row">
        <div class="col-12">
            <h2 style="font-weight: 600; font-size: 1.8rem; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                Confirm Your Purchase
            </h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <img src="{{ $product->image_url ?? asset('default-product.jpg') }}" 
                 alt="{{ $product->name }}" 
                 style="width: 100%; height: auto; border-radius: 5px; border: 1px solid #f0f0f0; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        </div>
        <div class="col-md-6">
            <h5 style="font-size: 1.5rem; font-weight: 600; color: #212121;">{{ $product->name }}</h5>
            <p style="font-size: 1.2rem; margin: 10px 0; color: #388e3c;">Price: ₹{{ number_format($product->price, 2) }}</p>
            <p style="font-size: 1rem; margin-bottom: 20px; color: #757575;">
                Available Quantity: <strong>{{ $product->quantity }}</strong>
            </p>
            @if ($product->quantity > 0)
                <p style="color: #388e3c; font-weight: 500;">In Stock</p>
            @else
                <p style="color: #d32f2f; font-weight: 500;">Out of Stock</p>
            @endif
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" 
               style="padding: 5px 20px; font-size: 1.1rem; border-radius: 5px; border: 1px solid #ddd; color: #757575;">
                Cancel
            </a>

            <form action="{{ route('user.buy.now.process', ['productId' => $product->id]) }}" method="POST">
                @csrf
                @if ($product->quantity > 0)
                    <button type="submit" class="btn btn-warning" 
                            style="padding: 5px 20px; font-size: 1rem; font-weight: 600; margin-top: 20px; color: #ffffff; background-color: #f9a825; border: none; border-radius: 5px;">
                        Confirm Purchase
                    </button>
                @else
                    <button type="button" disabled class="btn btn-secondary"
                            style="padding: 12px 30px; font-size: 1.2rem; font-weight: 600; color: #ffffff; border-radius: 5px;">
                        Out of Stock
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
