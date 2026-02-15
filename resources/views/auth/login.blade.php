<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Affifa’s Nadia’s</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login&register.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Brand / Title -->
            <div class="login-brand text-center">
                <h1>Login</h1>
                <p>Affifa’s Nadia’s</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        class="form-input"
                    >
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        class="form-input"
                    >
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group remember-me">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="form-group forgot-password">
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
                @endif

                <!-- Submit -->
                <div class="form-group">
                    <button type="submit" class="login-btn">Log In</button>
                </div>

                <!-- Register Link -->
                <p class="register-link text-center">
                    Don’t have an account? <a href="{{ route('register') }}">Register</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
