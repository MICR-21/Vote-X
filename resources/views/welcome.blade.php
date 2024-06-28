<!DOCTYPE html>
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

        body {
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
            color: #black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }


        .header {
            margin-top: 60px;
            font-size: 4em;
            font-weight: 600;
        }

        .description {
            font-size: 1.5em;
            margin: 20px 0;
        }

        .buttons {
            margin-top: 30px;
        }

        .buttons a {
            background-color: #0f0;
            color: #000;
            text-decoration: none;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s, color 0.3s;
        }

        .buttons a:hover {
            background-color: #0c0;
            color: #fff;
        }

    </style>
    </head>
    <body class="antialiased">
        <img src="C:\xampp\htdocs\Vote-X\resources\views\logo.png" alt="Logo" class="logo">
    <div class="header">
        WELCOME TO VOTE-X
    </div>
    <div class="description">
        Secure and Reliable E-Voting Platform
    </div>
        <div class=buttons>
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                         @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


