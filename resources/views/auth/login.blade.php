<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('css/styleshome.css') }}" rel="stylesheet" />

    <style>
        /* styleshome.css */
        body {
            background-color: #f8f9fa; /* Set a background color for the body */
        }

        /* Center the form vertically and horizontally */
        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff; /* Set a background color for the form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 500px; /* Adjust the width as needed */
        }

        /* Style form fields and labels */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Style the Login button */
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the footer */
        .footer {
            text-align: center;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }

        /* Adjust the margin-top of the footer to create separation */
        .footer {
            margin-top: 20px; /* Adjust the margin as needed */
        }

        /* Adjust the styles for small screens if needed */
        @media (max-width: 768px) {
            form {
                width: 80%;
            }
        }
    </style>
</head>

<body>
    @include('layouts.userheader')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<!-- Footer-->
@include('layouts.footer')
</body>

</html>
