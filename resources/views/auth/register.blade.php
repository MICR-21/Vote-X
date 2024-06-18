<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300">

    <!-- Custom Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .signin {
            background: #f7f7f7;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .content h2 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 2em;
            color: #333;
        }
        .form {
            display: flex;
            flex-direction: column;
        }
        .form div {
            margin-bottom: 15px;
        }
        .inputBox {
            width: 100%;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .inputBox:focus {
            border-color: #9b59b6;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 15px;
            background: #4CAF50;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #43A047;
        }
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .flex a {
            font-size: 12px;
            color: #4CAF50;
            text-decoration: none;
        }
        .flex a:hover {
            text-decoration: underline;
        }
        .mt-2 {
            margin-top: 8px;
            font-size: 12px;
            color: red;
        }
        .mt-4 {
            margin-top: 16px;
        }
        .already-registered {
            margin-top: 15px;
            text-align: center;
            font-size: 12px;
            color: #4CAF50;
        }
        .already-registered a {
            color: #4CAF50;
            text-decoration: none;
        }
        .already-registered a:hover {
            text-decoration: underline;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="signin">
        <div class="content">
            <h2>REGISTRATION</h2>
            <div class="form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="inputBox" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="inputBox" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="inputBox" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="inputBox" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

        <div>



            <button class="btn btn-primary">
                {{ __('Register') }}
            </button>

            <a href="{{ route('login') }}" class="text-xs-white">
    {{ __('Already registered?') }}
</a>
            </form>
        </div>
        </div>
    </div>
</body>
</html>
