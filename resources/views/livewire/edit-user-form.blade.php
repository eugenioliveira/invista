<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- E-mail -->
            <div class="w-full">
                <x-input
                        label="E-mail"
                        name="email"
                        class="mt-1 w-full"
                        wire:model.lazy="state.email"
                        error="{{ $errors->first('email') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- Senha -->
            <div class="w-1/2">
                <x-password-input
                        label="Senha"
                        name="password"
                        class="mt-1 w-full"
                        wire:model.lazy="state.password"
                        error="{{ $errors->first('password') }}"
                />
            </div>

            <!-- Confirmar senha -->
            <div class="w-1/2">
                <x-password-input
                        label="Confirmar senha"
                        name="password_confirmation"
                        class="mt-1 w-full"
                        wire:model.lazy="state.password_confirmation"
                        error="{{ $errors->first('password_confirmation') }}"
                />
            </div>
        </x-input-row>

        @if (\Auth::user()->isAdmin())
            @include('livewire.partials.role-radio-input')
        @endif

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updateUser">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updateUser(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('users.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>