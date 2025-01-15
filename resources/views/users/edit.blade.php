@extends('layouts.app')

@section('content')

<!-- Custom CSS -->
<style>
    .custom-form-container {
        max-width: 700px;
        margin: 50px auto;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px 30px;
    }

    .custom-form-container h3 {
        text-align: center;
        color: #4c6ef5;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        border-radius: 6px;
        font-size: 1rem;
        padding: 10px 15px;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #4c6ef5;
        box-shadow: 0 0 5px rgba(76, 110, 245, 0.5);
    }

    .custom-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .custom-buttons .btn {
        padding: 8px 20px;
        font-size: 1rem;
        border-radius: 6px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<div class="custom-form-container">
    <h3>Edit User</h3>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                value="{{ old('name', $user->name) }}" 
                placeholder="Enter full name" 
                required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email', $user->email) }}" 
                placeholder="Enter email address" 
                required>
        </div>

        <!-- phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input 
                type="phone" 
                id="phone" 
                name="phone" 
                class="form-control" 
                value="{{ old('phone', $user->phone) }}" 
                placeholder="Enter phone" 
                required>
        </div>

    <!-- address -->
    <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input 
                type="text" 
                id="address" 
                name="address" 
                class="form-control" 
                value="{{ old('address', $user->address) }}" 
                placeholder="Enter address" 
                required>
        </div>


        <!-- Buttons -->
        <div class="custom-buttons">
            <a href="{{ route('users') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
    </form>
</div>

@endsection
