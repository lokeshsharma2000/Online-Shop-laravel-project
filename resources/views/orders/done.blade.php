@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px; margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card success-card">
                <div class="card-body text-center">
                    <i class="fa fa-check-circle success-icon"></i>
                    <h3 class="success-heading">Order Successful</h3>
                    <p class="success-message">Thank you for shopping with us! Your order has been successfully placed.</p>

                    <div class="mt-4">
                        <a href="{{ route('user.orders') }}" class="btn btn-success">View Your Orders</a>
                    </div>

                    <div class="mt-3">
                        <a href="{{ url('/') }}" class="btn btn-outline-primary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
/* Page container styling */
.container {
    max-width: 700px;
    margin-top: 50px;
}

/* Success card styling */
.success-card {
    border-radius: 15px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

/* Icon styling */
.success-icon {
    font-size: 5rem;
    color: #2ecc71; /* Success Green */
    margin-bottom: 20px;
}

/* Heading styling */
.success-heading {
    font-weight: 700;
    font-size: 2rem;
    margin-top: 20px;
    color: #2ecc71;
}

/* Paragraph styling */
.success-message {
    font-size: 1.2rem;
    color: #555;
}

/* Button styling */
.btn {
    font-size: 1.2rem;
    padding: 12px 30px;
    border-radius: 30px;
    text-align: center;
    display: block;
    width: 70%;
    margin: 10px 0; /* For vertical spacing */
}

/* Success button styling */
.btn-success {
    background-color: #2ecc71;
    border: none;
    color: #fff;
    font-weight: 600;
}

/* Outline button styling */
.btn-outline-primary {
    border: 1px solid #007bff;
    color: #007bff;
    font-weight: 600;
}

/* Hover effects for buttons */
.btn-success:hover {
    background-color: #27ae60;
}

.btn-outline-primary:hover {
    color: #0056b3;
    border-color: #0056b3;
}

/* Small screen adjustments */
@media (max-width: 768px) {
    .success-heading {
        font-size: 1.8rem;
    }

    .success-message {
        font-size: 1.1rem;
    }
}
</style>
@endsection
