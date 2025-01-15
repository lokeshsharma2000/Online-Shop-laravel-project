<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
 
</head>
<body>
   <!-- <nav> -->
        <!-- Navigation links go here -->
        <!-- <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
        </ul>
    </nav> -->
    
    <div class="container">
        @yield('content') <!-- This is where your page content will go -->
    </div>
   
</body>
</html>
