<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Cropper.js CSS for image cropping -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the form */
        .input-label {
            color: black; /* Set the text color to black or any other visible color */
        }
        .cropper-container {
            max-width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" class="input-label" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="input-label" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div>
                <x-input-label for="profile_image" :value="__('Profile Image')" class="input-label" />
                <!-- Input for image selection -->
                <input id="profile_image" name="profile_image" type="file" class="mt-1 block w-full text-gray-700 dark:text-gray-300" accept="image/*" />

                <!-- Preview area for selected image -->
                <div class="mt-2">
                    <img id="image-preview" src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://via.placeholder.com/150' }}" alt="Profile Image" class="h-20 w-20 rounded-full">
                </div>

                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </section>

    <!-- Cropper.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <!-- JavaScript code for image cropping -->
    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Get the input element for file selection
            const input = document.getElementById('profile_image');
            // Get the preview image element
            const image = document.getElementById('image-preview');
            // Initialize Cropper.js with options
            let cropper = new Cropper(image, {
                aspectRatio: 1, // Set the aspect ratio to 1:1 (square)
                viewMode: 1, // Restrict the crop box to stay within the preview area
                autoCropArea: 1, // Automatically set the crop area to cover the preview area
                responsive: true, // Enable responsive mode
                crop: function(event) {
                    // Output the cropped area data into console for reference
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            });

            // Event listener for when a file is selected
            input.addEventListener('change', function (e) {
                // Check if any file is selected
                if (e.target.files.length > 0) {
                    // Get the selected file
                    const file = e.target.files[0];
                    // Initialize a FileReader to read the file
                    const reader = new FileReader();
                    // Set the onload event handler of FileReader
                    reader.onload = function (event) {
                        // Set the source of the preview image to the uploaded image
                        image.src = event.target.result;
                        // Destroy the old Cropper instance and create a new one with updated image source
                        cropper.destroy();
                        cropper = new Cropper(image, {
                            aspectRatio: 1, // Set the aspect ratio to 1:1 (square)
                            viewMode: 1, // Restrict the crop box to stay within the preview area
                            autoCropArea: 1, // Automatically set the crop area to cover the preview area
                            responsive: true, // Enable responsive mode
                        });
                    };
                    // Read the selected file as Data URL (base64 format)
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                // Get the cropped canvas
                const canvas = cropper.getCroppedCanvas();
                if (!canvas) {
                    return;
                }
                // Convert canvas to blob
                canvas.toBlob(function (blob) {
                    // Create a new FormData object
                    const formData = new FormData(form);
                    // Append the cropped image blob to the FormData object
                    formData.append('profile_image', blob, 'profile.jpg');
                    // Send the form data to the server using fetch
                    fetch('{{ route('profile.update') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        // Optionally, update UI to show success message or redirect to another page
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        // Optionally, update UI to show error message
                    });
                }, 'image/jpeg');
            });
        });
    </script>
</body>
</html>
