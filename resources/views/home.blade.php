@extends('layouts.app')

@section('content')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40; /* Dark theme background */
            color: #ffffff; /* Text color */
            height: 100vh;
            position: fixed; /* Keep it fixed to the left */
            left: 0; /* Sidebar appears on the left */
            top: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #4e555b; /* Subtle border to separate header */
            text-align: center;
        }

        .nav {
            flex-grow: 1;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link i {
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .nav-link:hover {
            background-color: #495057; /* Highlight on hover */
            color: #ffffff;
        }

        .logout {
            color: #e74c3c; /* Red color for logout */
            margin-top: auto; /* Push it to the bottom */
        }

        .logout:hover {
            background-color: #c0392b;
            color: #ffffff;
        }

        .container {
            margin-left: 260px; /* Leave space for the sidebar */
            padding: 20px;
        }

        .logout-btn {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-btn:hover {
            color: #c0392b;
        }

        /* Mobile View (Optional) */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Full width for mobile */
                height: auto;
                position: relative; /* Release from fixed position */
            }
            .container {
                margin-left: 0;
            }
        }
    </style>

    <nav class="sidebar">
        <div class="sidebar-header">
            <h4>Admin Panel</h4>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.product.index')}}">
                    <i class="bi bi-box"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.category.index')}}">
                    <i class="bi bi-tags"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/orders">
                    <i class="bi bi-cart"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.subcategory.index')}}">
                    <i class="bi bi-cart"></i> SubCategory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/settings">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link logout" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <p>This is the home page of your application. You can customize this content.</p>
        <h1>User Info:</h1>
        <ul>
            <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
            <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
            <li><strong>Joined on:</strong> {{ auth()->user()->created_at->format('d-m-Y') }}</li>
    </ul>
@endsection
