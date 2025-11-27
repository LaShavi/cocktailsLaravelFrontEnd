<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between mt-6">
            <a href="/" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 font-semibold">
                ← Atrás
            </a>

            <x-primary-button class="ms-0">
                Iniciar Sesión
            </x-primary-button>
        </div>

        <!-- Additional Links -->
        <div class="flex items-center justify-between mt-3">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @else
                <div></div>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear Cuenta
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
