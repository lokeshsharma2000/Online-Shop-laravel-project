@extends('layouts.app')

@section('content')
<a href="{{ route('home') }}" class="back-button btn btn-danger">Back</a>
<div class="user-info">
    <h1>User Info</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ auth()->user()->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ auth()->user()->phone }}</li>
        <li class="list-group-item"><strong>Adress:</strong> {{ auth()->user()->address }}</li>
        <li class="list-group-item"><strong>Joined on:</strong> {{ auth()->user()->created_at->format('d-m-Y') }}</li>
    </ul>
</div>
@endsection

<style>
    /* Container for user info */
    .user-info {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        width: 60%;
        margin: 0 auto;
    }

    h1 {
        font-size: 30px;
        color: #333;
        margin-bottom: 20px;
    }

    /* List styling */
    .list-group {
        list-style-type: none;
        padding: 0;
    }

    .list-group-item {
        padding: 15px;
        font-size: 18px;
        color: #555;
        background-color: #ffffff;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .list-group-item strong {
        color: #007bff; /* Blue color for labels */
    }

    /* Optional hover effect */
    .list-group-item:hover {
        background-color: #f1f1f1;
        border-color: #ccc;
    }

    /* Adding margin to page for alignment */
    .user-info ul {
        margin-top: 10px;
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
