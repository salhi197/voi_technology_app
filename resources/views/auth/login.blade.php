<x-guest-layout>
    <style>
        body { background: #04342C !important; }
        .auth-card {
            background: #085041;
            border-radius: 16px;
            padding: 2.5rem;
            max-width: 400px;
            margin: 0 auto;
        }
        .auth-card label { color: #9FE1CB !important; font-weight: 500; }
        .auth-card input[type="email"],
        .auth-card input[type="password"] {
            background: #04342C !important;
            border: 1px solid rgba(225,245,238,0.2) !important;
            color: #E1F5EE !important;
            border-radius: 8px !important;
        }
        .auth-card input:focus {
            border-color: #5DCAA5 !important;
            box-shadow: 0 0 0 1px #5DCAA5 !important;
        }
        .auth-card .btn-login {
            background: #1D9E75 !important;
            border: none !important;
            color: #04342C !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            padding: 10px !important;
        }
        .auth-card .btn-login:hover { background: #5DCAA5 !important; }
        .auth-card a { color: #5DCAA5 !important; }
        .auth-logo {
            width: 48px; height: 48px;
            border-radius: 10px;
            background: #04342C;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
        }
    </style>

    <div class="auth-card">
        <div class="auth-logo">
            <i class="ti ti-bolt" style="font-size: 24px; color: #5DCAA5;"></i>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded" name="remember">
                    <span class="ms-2 text-sm" style="color: #9FE1CB;">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="btn-login ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>