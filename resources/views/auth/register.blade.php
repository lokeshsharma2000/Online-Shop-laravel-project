<!-- Registration Form -->
<form method="POST" action="{{ route('register') }}" id="register-form">
    @csrf
    <div class="header-container">
        <a href="javascript:history.back()" class="back-button">Back</a>
        <h2>Create an Account</h2>

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

    <!-- Name Field -->
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Name">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Field -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Password">
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password Field -->
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm Password">
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
    <label for="phone">Phone</label>
    <input type="phone" id="phone" name="phone" required placeholder="phone">
</div>


<div class="form-group">
    <label for="address">Address</label>
    <input type="address" id="address" name="address" required placeholder="address">
</div>

    <button type="submit" id="register-button">Register</button>
</form>

<style>
    /* Registration Form Styling */
    #register-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #register-form h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .header-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .back-button {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
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

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-group input:focus {
        border-color: #28a745;
        outline: none;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }

    #register-button {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #register-button:hover {
        background-color: #218838;
    }

    #register-button:focus {
        outline: none;
    }

    /* Error message style */
    .alert.alert-danger {
        font-size: 14px;
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 10px;
        margin-top: 5px;
        border-radius: 4px;
    }
</style>
