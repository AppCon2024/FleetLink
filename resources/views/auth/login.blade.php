<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="sm:text-sm text-xs" />
            <x-text-input id="email" class="block mt-[2px] w-full sm:text-sm text-xs" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 sm:text-sm text-xs" />
        </div>

        @if (session('error'))
            <div class="text-red-500 text-xs p-1">{{ session('error') }}</div>
        @endif

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="sm:text-sm text-xs" />
            <x-text-input id="password" class="block mt-[2px] w-full sm:text-sm text-xs" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 sm:text-sm text-xs" />
        </div>

        <!-- Remember Me -->
        <div class=" mt-4 flex justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 sm:text-sm text-xs text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            <div class="flex items-center justify-start">
                <a class="underline sm:text-sm text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </div>

        </div>




        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="sm:w-9/12 w-full flex items-center justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex items-center justify-center mt-2">
            @if (Route::has('password.request'))
                <a class="hover:underline sm:text-sm text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>


</x-guest-layout>
