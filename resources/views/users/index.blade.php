@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Users</h1>
    <a href="{{route('home')}}" class="back-button">Back</a>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <div class="d-flex justify-content-center">
    <ul class="pagination">
        @for ($i = 1; $i <= $users->lastPage(); $i++)
            <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
    </ul>
</div>

</div>

<style>
    .pagination .active a {
        background-color: #007bff;
        color: white;
        pointer-events: none;
    }
    .back-button {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        margin-bottom:2px;
        font-weight: bold;
        color: #fff;
        background-color: #ff4d4d; /* Red background color */
        border: none;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-right: 20px; /* Adds spacing between the back button and title */
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
