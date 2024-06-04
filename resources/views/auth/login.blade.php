<x-guest1-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h2>LOGIN</h2>
    <div class="login-page">


    <div class="form">

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div class="inputBox">
            <x-input-label for="email" :value="__('Email')" />
            <input id="email" class="inputBox"type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="inputBox">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="inputBox"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->



            <button>
                {{ __('Log in') }}
            </button>
            <div class="links">
            @if (Route::has('password.request'))
                <a class="links" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <p class="message">Not registered? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </div>
    </div>
    </form>
</x-guest-layout>

