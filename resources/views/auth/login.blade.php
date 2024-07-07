
    <style>
        .body {
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
        }
        .login-container {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #4f46e5;
            text-align: center;
            margin-bottom: 1rem;
        }

        .login-input {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
        }

        .login-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .login-button {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
            width: 100%;
        }

        .login-button:hover {
            background-color: #3730a3;
        }

        .forgot-password, .register-link {
            text-align: right;
            color: #4f46e5;
            transition: color 0.3s;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .forgot-password:hover, .register-link:hover {
            color: #3730a3;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .login-social {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .login-social button {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            display: flex;
            align-items: center;
        }

        .login-social button img {
            margin-right: 0.5rem;
        }

        .login-social button:hover {
            background-color: #f3f4f6;
            border-color: #4f46e5;
        }
    </style>
<body class="body" >
    <div class="login-container">
        <div class="login-box">
            <h2 class="login-title">{{ __('Login') }}</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('register') }}" class="register-link">
                        {{ __('Register here') }}
                    </a>

                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-button">
                    {{ __('Log in') }}
                </button>
            </form>
        </div>
    </div>
</body>
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VOTE-X</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        .body {
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
        }

        .login-container {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #4f46e5;
            text-align: center;
            margin-bottom: 1rem;
        }

        .login-input {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
        }

        .login-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .login-button {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
            width: 100%;
        }

        .login-button:hover {
            background-color: #3730a3;
        }

        .forgot-password, .register-link {
            text-align: right;
            color: #4f46e5;
            transition: color 0.3s;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .forgot-password:hover, .register-link:hover {
            color: #3730a3;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .login-social {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .login-social button {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
            display: flex;
            align-items: center;
        }

        .login-social button img {
            margin-right: 0.5rem;
        }

        .login-social button:hover {
            background-color: #f3f4f6;
            border-color: #4f46e5;
        }
    </style>
</head>
<body class="body">
    <div class="login-container">
        <div class="login-box">
            <h2 class="login-title">{{ __('Login') }}</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" pattern="[a-zA-Z0-9._%+-]+@strathmore\.edu" title="Please enter a valid Strathmore University email address (e.g., user@strathmore.edu)" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('register') }}" class="register-link">
                        {{ __('Register here') }}
                    </a>

                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-button">
                    {{ __('Log in') }}
                </button>
            </form>
        </div>
    </div>
</body>
</html> --}}



