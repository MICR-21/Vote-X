<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lock Screen</title>
    <link rel="stylesheet" href="{{ asset('resource/css/styles.css') }}">
</head>
<body>
    <div id="lockScreen">
        <div class="lock-container">
            <!-- Session Status -->
            {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

            <!-- Error Message -->
            @if(session()->has('error'))
                <div class="text-danger text-center text-bold">
                    {{ session()->get('error') }}
                </div>
            @endif

            <h1 class="auth-title">Lock Screen.</h1>
            <p class="auth-subtitle mb-5">Lock screen system management</p>

            <form method="POST" action="{{ route('unlock') }}">
                @csrf
                <section>
                    <div class="content">
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-6 w-full" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('Unlock Screen') }}
                            </x-primary-button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

</body>
</html>
