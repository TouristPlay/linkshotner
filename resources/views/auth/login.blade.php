<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img class="block h-24 w-auto" src="{{ asset('img/logo2.png') }}" alt="">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-jet-label for="username" value="{{ __('Имя пользователя') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username"
                    :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Пароль') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Регистрация') }}
                </a>


                <div class="flex justify-end items-center">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Забыли пароль?') }}
                    </a>
                    @endif

                    <x-jet-button class="ml-4">
                        {{ __('Войти') }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
