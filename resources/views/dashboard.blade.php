<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{ route('lock_screen') }}">Lock Screen</a>
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

    {{-- <main>
        <h1>WELCOME TO VOTE-X <span>{{ Auth::user()->name }}</span></h1>
    </main>

    <div class="sidebar" id="sidebar">
        <h2>Edit Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <!-- <input type="hidden" name="_method" value="PUT"> -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>
            <div class="form-group">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div> --}}

    <script>
        function handleLogout(event) {
            event.preventDefault();

            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    window.location.replace('/login');
                }
            });
        }

        function openSidebar() {
            document.getElementById('sidebar').style.display = 'block';
        }

        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    </script>
</x-app-layout>
