@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin-top: 30px;">
    <div class="row">
        <div class="col-12">
            <h2 style="font-weight: 600; font-size: 2rem; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                Your Orders
                <a href="{{ url('/') }}" class="btn back-button">Continue Shopping</a>
            </h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-striped table-bordered" style="border-radius: 10px;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{$order->user->name}}</td>
                        <td>₹{{ number_format($order->totalPrice, 2) }}</td>
                        <td>
                            <span class="badge @if($order->status == 'Pending') badge-warning @elseif($order->status == 'Completed') badge-success @else badge-secondary @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{route('user.orderdetail',['orderID'=>$order->id])}}" class="btn btn-info">Details</a> <!-- Details Button -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
/* General styling */
body {
    font-family: 'Arial', sans-serif;
}

/* Styling the orders page */
.container {
    max-width: 900px;
    margin-top: 30px;
}

/* Table Styling */
.table {
    width: 100%;
    background-color: #fff;
    border-collapse: collapse;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px 15px;
    text-align: center;
    font-size: 1rem;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #f9f9f9;
    color: #212121;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
}

/* Hover effects for rows */
.table tr:hover {
    background-color: #f1f1f1;
}

/* Badge Styles for Status */
.badge {
    font-size: 1rem;
    font-weight: 600;
    padding: 6px 15px;
    border-radius: 20px;
    color: #fff;
}

.badge-warning {
    background-color: #f39c12;
}

.badge-success {
    background-color: #2ecc71;
}

.badge-secondary {
    background-color: #bdc3c7;
}

/* Headings */
h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #212121;
}

/* Details button */
.btn-info {
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 25px;
    background-color: #3498db;
    color: #fff;
    border: none;
}

.btn-info:hover {
    background-color: #2980b9;
}

/* Responsive Table for Smaller Screens */
@media (max-width: 768px) {
    .table th, .table td {
        font-size: 0.9rem;
        padding: 8px;
    }

    h2 {
        font-size: 1.7rem;
    }
}

.back-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 20px;
        margin-bottom:2px;
        font-weight: bold;
        color: #fff;
        background-color: #ff4d4d; /* Red background color */
        border: none;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-right: 20px;
        margin-left: 50px;

    }

    .back-button:hover {
        background-color: #cc0000; /* Darker red on hover */
        transform: translateY(-1px); /* Slight lift effect */
    }

    .back-button:active {
        background-color: #a30000; /* Even darker red when clicked */
        transform: translateY(0); /* Button pressed effect */
    }
</style>
@endsection
