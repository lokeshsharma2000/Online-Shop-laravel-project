@extends('layouts.app')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('home') }}" class="back-button btn btn-danger">Back</a>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add Category</a>

    <!-- Table Styling -->
    <table class="table table-bordered mt-4">
        <thead>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td><img src="{{asset('storage')}}/categories/{{$category->image}}" alt="{{ $category->title }}" width="100" height="100"></td>

                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline;">
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

