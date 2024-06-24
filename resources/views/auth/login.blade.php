{{-- <x-guest-layout> --}}
    <style>
        .login-container {
            background: #f3f4f6;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
            background-color: #ffffff;
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
    </style>

    <div class="login-container">
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
{{-- </x-guest-layout> --}}
