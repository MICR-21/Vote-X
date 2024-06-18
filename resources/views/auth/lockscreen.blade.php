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
            <x-auth-session-status class="mb-4" :status="session('status')" />

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
                        <x-primary-button class="ms-3">
                            {{ __('Unlock Screen') }}
                        </x-primary-button>
                    </div>
                </section>
            </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                </a>
                </form>
        </div>
    </div>
    <script>
        // This flag indicates if the lock screen is active
        let isLockActive = true;

        // Function to redirect to the lock screen
        function redirectToLockScreen() {
            if (isLockActive) {
                window.location.replace("{{ route('lock_screen') }}");
            }
        }

        // Event listener for the back button
        window.addEventListener('popstate', function () {
            redirectToLockScreen();
        });

        // Event listener for hash changes (e.g., URL changes without reloading the page)
        window.addEventListener('hashchange', function () {
            redirectToLockScreen();
        });

        // Event listener for beforeunload (e.g., when the user tries to leave the page)
        window.addEventListener('beforeunload', function (event) {
            if (isLockActive) {
                event.preventDefault();
                event.returnValue = ''; // Some browsers require returnValue to be set
            }
        });

        // Function to deactivate the lock screen (call this on successful unlock)
        function unlockScreen() {
            isLockActive = false;
        }

        // Check if the unlock form is submitted successfully
        document.querySelector('form').addEventListener('submit', function () {
            unlockScreen();
        });
    </script>
</body>

</html>
