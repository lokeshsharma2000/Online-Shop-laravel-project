@extends('layouts.app')

@section('content')
<style>
    /* Add some base styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    h1 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }
    h3 {
        font-size: 22px;
        margin-top: 20px;
        text-align: right;
        color: #333;
    }

    /* Table styles */
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 15px;
        text-align: left;
        vertical-align: middle;
    }
    .table th {
        background-color: #f5f5f5;
        color: #333;
        font-weight: 600;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Image styling */
    .product-image {
        width: 100px;
        height: auto;
        border-radius: 8px;
    }

    /* Product info */
    .product-info {
        font-size: 16px;
        color: #333;
    }

    .product-info .product-name {
        font-size: 18px;
        font-weight: 600;
        color: #0071e3;
    }

    .product-info .product-quantity {
        font-size: 16px;
        color: #888;
    }

    .price {
        color: #ff5722;
        font-weight: 600;
    }

    .total-price {
        font-weight: 600;
        font-size: 20px;
        color: #ff5722;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 14px;
        }
        .product-image {
            width: 80px;
        }
        h1 {
            font-size: 20px;
        }
        h3 {
            font-size: 18px;
        }
    }
    .back-button {
            display: inline-block;
            padding: 10px 25px;
            font-size: 10px;
            font-weight: bold;
            color: #ffffff;
            background-color: #dc3545; /* Red color */
            text-decoration: none;
            border-radius: 5px;
            border: 2px solid #a71d2a; /* Darker red border */
            transition: all 0.3s ease;
        }
        .back-button:hover {
            background-color: #a71d2a; /* Darker red on hover */
            color: #ffffff;
            transform: scale(1.05); /* Slight zoom-in effect */
        }
        .back-button:active {
            transform: scale(1); /* Reset zoom-in effect */
            background-color: #7f1220; /* Even darker red on active */
        }
</style>

<div class="container">
<button onclick="history.back()"class='back-button'>Go Back</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (per Product)</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $item)
                <tr>
                    <td>
                        <img class="product-image" src="{{ asset('storage/products/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                    </td>
                    <td>
                        <div class="product-info">
                            <div class="product-name">{{ $item->product->title }}</div>
                        </div>
                        <td>
                        <div class="product-quantity">Quantity: {{ $item->quantity }}</div>
                        </td>
                    </td>
                    <td>
                        <div class="price">${{ number_format($item->price, 2) }}</div>
                    </td>
                    <td>
                        <div class="price">${{ number_format($item->total, 2) }}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
