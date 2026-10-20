<x-guest-layout>
    <!-- اللوجو والترحيب -->
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 mb-2">
        <h2 class="text-2xl font-black mt-3 text-black tracking-tight text-center">CREATE AN ACCOUNT</h2>
        <p class="text-gray-400 text-sm mt-1 text-center">Join us and start exploring today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-600 font-semibold mb-1" />
            <x-text-input id="name" class="block w-full rounded-lg border-gray-200 bg-gray-50 focus:bg-white focus:border-black focus:ring-black transition-colors" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600 font-semibold mb-1" />
            <x-text-input id="email" class="block w-full rounded-lg border-gray-200 bg-gray-50 focus:bg-white focus:border-black focus:ring-black transition-colors" type="email" name="email" :value="old('email')" placeholder="Enter your email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone (اللي إنت ضفته) -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" class="text-gray-600 font-semibold mb-1" />
            <x-text-input id="phone" class="block w-full rounded-lg border-gray-200 bg-gray-50 focus:bg-white focus:border-black focus:ring-black transition-colors" type="text" name="phone" :value="old('phone')" placeholder="Enter your phone number" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 font-semibold mb-1" />
            <x-text-input id="password" class="block w-full rounded-lg border-gray-200 bg-gray-50 focus:bg-white focus:border-black focus:ring-black transition-colors"
                            type="password"
                            name="password"
                            placeholder="Create a password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-600 font-semibold mb-1" />
            <x-text-input id="password_confirmation" class="block w-full rounded-lg border-gray-200 bg-gray-50 focus:bg-white focus:border-black focus:ring-black transition-colors"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm your password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-all">
                {{ __('Sign Up') }}
            </button>
        </div>

        <!-- Already registered -->
        <div class="text-center mt-4 text-sm text-gray-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-black hover:underline">Log in</a>
        </div>

    </form>
</x-guest-layout>