@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('home') }}" class="back-button btn btn-danger">Back</a>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add products</a>

    <!-- Table Styling -->
    <table class="table table-bordered mt-4">
        <thead>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

            <tr>
                <th>Title</th>
                <th>category</th>
                <th>subcategory</th>
                <th>price</th>
                <th>Quantity</th>
                <th>expiryDate</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{$product->category->title }}</td>
                    <td>{{$product->subcategory->title }}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->expiryDate ?? 'N/A' }}</td>
                    <td><img src="{{asset('storage')}}/products/{{$product->image}}" alt="{{ $product->title }}" width="100" height="100"></td>
                    <td>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

<style>
    /* Table Styling */
    table.table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table.table th, table.table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table.table th {
        background-color: #f8f9fa;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    table.table td img {
        border-radius: 8px;
    }

    table.table .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
        margin-right: 5px; /* Adds space between action buttons */
    }

    

    .alert {
        text-align: center;
        margin-top: 20px;
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

