<!-- Your Login Form -->
 <!-- Display Validation Errors -->
 @if($errors->any())
    <div class="error-container">
        <ul class="error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>

    .error-container {
        margin: 20px 0;
        padding: 15px;
        border: 1px solid #ff4d4d; 
        border-radius: 8px;
        background-color: #ffe6e6; 
        font-family: Arial, sans-serif;
        color: #cc0000; 
    }

    /* List styling for error messages */
    .error-list {
        margin: 0;
        padding: 0;
        list-style-type: none; /* Remove default bullets */
    }

    .error-list li {
        margin: 5px 0;
        padding-left: 20px;
        position: relative;
        font-size: 14px;
        font-weight: 500;
    }

    /* Add a bullet indicator */
    .error-list li::before {
        content: "⚠️"; /* Warning icon as bullet */
        position: absolute;
        left: 0;
    }
</style>

<form method="POST" action="{{ route('login') }}" id="login-form">
    @csrf
    <a href="javascript:history.back()" class="back-button">Back</a>

    <h2>Login</h2>

    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Password">
</div>


    <div class="button-group">
        <button type="submit" id="login-button">Login</button>
        <a href="{{ route('register') }}" id="signup-button">Sign Up</a>
    </div>
</form>

<style>
    /* Login Form Styling */
    #login-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #login-form h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
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
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Button Group Styling */
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    #login-button,
    #signup-button {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        text-align: center;
        border-radius: 4px;
        text-decoration: none;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #login-button {
        background-color: #007bff;
        border: none;
    }

    #login-button:hover {
        background-color: #0056b3;
    }

    #signup-button {
        background-color: #28a745;
        border: none;
    }

    #signup-button:hover {
        background-color: #218838;
    }

    #login-button:focus,
    #signup-button:focus {
        outline: none;
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
</style>
