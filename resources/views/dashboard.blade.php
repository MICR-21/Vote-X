<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

            <form method="POST" action="{{ route('lock_screen') }}">
                @csrf
                <button type="submit">
                    {{ __('Lock Screen') }}
                </button>
            </form>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };

    // Inactivity timer script
    let inactivityTime = function () {
        let time;
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;

        function lockScreen() {
    // Prepare the data to be sent in the POST request
    const postData = {
        _token: '{{ csrf_token() }}'
    };

    // Configure the fetch request
    fetch('{{ route("lock_screen") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
    })
    .then(response => {
        // Check if the request was successful
        if (response.ok) {
            // Redirect to the lock screen
            window.location = '{{ route('lock_screen') }}';
        } else {
            // Handle the error scenario
            console.error('Lock screen request failed:', response.statusText);
            // Optionally, you can display an error message to the user
        }
    })
    .catch(error => {
        // Handle any network errors
        console.error('Lock screen request failed:', error.message);
        // Optionally, you can display an error message to the user
    });
}

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(lockScreen, 10000);  // 10 sec of inactivity
        }
    };

    inactivityTime();
</script>
