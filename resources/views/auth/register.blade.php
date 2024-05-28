<x-guest-layout>
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
        <div class="inputBox">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="inputBox" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="inputBox">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="inputBox"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="inputBox"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

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
</div>
    </form>
</x-guest-layout>
