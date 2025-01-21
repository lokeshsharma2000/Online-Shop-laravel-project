<!DOCTYPE html>
<html lang="en">
<head>
<title>Products</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card h5 {
            font-size: 18px;
            font-weight: bold;
        }
        .product-card p {
            margin: 5px 0;
        }
        .price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }
        .btn-buy {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-buy:hover {
            background-color: #e64a19;
        }
    </style>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
             
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('user.showuser')}}">Edit Profile</a></li>
                     
                    </ul>
                </li>
                <li><a href="{{ route('user.user.info')}}">Profile</a></li>
                <li><a href="{{route('user.cart.index')}}">Cart</a></li>
                <li><a href="{{route('user.orders')}}">Orders</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span> Logout
                    </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2 class="text-center">Shop - Product List</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                        <h5>{{ $product->title }}</h5>
                        <p>Category: {{ $product->category->title }}</p>
                        <p>Type: {{ $product->subcategory->title }}</p>
                        <p class="price">₹{{ $product->price }}</p>
                        <a href="{{route('user.buy.now',['productId' => $product->id])}}" class="btn-buy">Buy Now</a>
                        <a href="{{route('user.cart.add',['productId' => $product->id])}}" class="btn-buy">Add To Cart</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
