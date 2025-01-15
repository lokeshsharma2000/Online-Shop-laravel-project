<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .cart-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .cart-item-details {
            flex: 1;
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
</head>
<body>
<div>
    <!-- Success Notification -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Notification -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
    <div class="container">
        <a href="{{ route('home') }}" class="back-button btn btn-danger">Back</a>
        <h2 class="text-center">Your Shopping Cart</h2>
        @foreach ($cartItems as $item)
            <div class="cart-item">
                <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                <div class="cart-item-details">
                    <h4>{{ $item->product->name }}</h4>
                    <p>Price: ₹{{ $item->product->price }}</p>
                    <p>Quantity: {{ $item->quantity }}</p>
                    <p>Total: ₹{{ $item->quantity * $item->product->price }}</p>
                    <form action="{{ route('user.cart.remove', ['cartItemId' => $item->id]) }}" method="POST" class="remove-item-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger remove-item" data-id="{{ $item->id }}">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeButtons = document.querySelectorAll('.remove-item');

        removeButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form'); 
                const itemId = this.getAttribute('data-id'); 

            
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, you can add again",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    } else {
                        Swal.fire('Your item is safe!'); 
                    }
                });
            });
        });
    });
</script>
</body>
</html>