<!-- resources/views/lockScreen.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lock Screen</title>
    <link rel="stylesheet" href="{{ asset('..public/resource/css/styles.css') }}">
</head>
<body>
    <div id="lockScreen">
        <div class="lock-container">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('unlock') }}">
                @csrf

                <section>
                    <!-- Generate empty spans for the visual effect -->
                    @for ($i = 0; $i < 256; $i++)
                        <span></span>
                    @endfor

                    <div class="content">
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-6 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('lock Screen') }}
                            </x-primary-button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</body>
</html>
