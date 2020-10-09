<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-login-bg">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <!-- Logo and Brand -->
            <div class="flex items-center justify-center">
                <!-- Logo -->
                <div>
                    <x-logo width="50" />
                </div>
                <!-- Brand -->
                <div>
                    <h2 class="text-2xl uppercase">
                        <span class="font-medium">Caixeta</span>
                        <span class="font-bold">Vendas</span>
                    </h2>
                </div>
            </div>

            <hr class="my-2">

            <!-- Login form -->
            <div class="py-5">
                <x-validation-errors class="mb-4"/>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label for="email" value="E-mail"/>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus/>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="Senha"/>
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-orange-600 hover:text-orange-900" href="{{ route('password.request') }}">
                                Esqueceu sua senha?
                            </a>
                        @endif

                        <x-button class="ml-4">
                            Login
                        </x-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
