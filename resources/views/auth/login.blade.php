<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-login-bg">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            {{-- Logo and Brand --}}
            <div class="flex items-center justify-center">
                {{-- Logo --}}
                <!--<div>
                    <x-logo width="50" />
                </div>-->
                {{-- Brand --}}
                <div>
                    <h2 class="text-2xl uppercase">
                        <span class="font-medium">Sistema Invista</span>
                    </h2>
                </div>
            </div>

            <hr class="my-2">

            {{-- Login form --}}
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
                        <x-input
                            label="E-mail"
                            name="email"
                            class="mt-1 w-full"
                            value="{{ old('email') }}"
                            required autofocus
                        />
                    </div>

                    <div class="mt-4">
                        <x-input
                            label="Senha"
                            type="password"
                            name="password"
                            class="mt-1 w-full"
                            required autocomplete="current-password"
                        />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-primary hover:text-yellow-900" href="{{ route('password.request') }}">
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
