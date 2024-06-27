<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .not-forgotten, .register-link {
            color: #4f46e5;
            transition: color 0.3s;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .not-forgotten:hover, .register-link:hover {
            color: #3730a3;
        }

        .email-input {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .forgot h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            color: #4f46e5;
        }

        .description {
            font-size: 1rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #666;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input[type="email"] {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input[type="email"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .submit-button {
            display: flex;
            justify-content: center;
        }

        .submit-button button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
            width: 100%;
        }

        .submit-button button:hover {
            background-color: #3730a3;
        }

        .link-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot">
            <h2>{{ __('FORGOT YOUR PASSWORD?') }}</h2>
            <p class="description">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                 <x-text-input id="email" class="email-input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="submit-button">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
            <div class="link-container">
                <a class="not-forgotten" href="{{ route('login') }}">
                    {{ __('Not forgotten?') }}
                </a>
                <a class="register-link" href="{{ route('register') }}">
                    {{ __('Register here') }}
                </a>
            </div>
        </form>
    </div>
</body>
</html>
