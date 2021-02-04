@php
    /** @var \App\Models\User $user */
@endphp
<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- Primeiro Nome -->
            <div class="w-1/3">
                <x-input
                        label="Primeiro nome"
                        name="first_name"
                        class="mt-1 w-full"
                        wire:model.lazy="state.first_name"
                        error="{{ $errors->first('first_name') }}"
                />
            </div>
            <!-- Sobrenome -->
            <div class="w-1/3">
                <x-input
                        label="Sobrenome"
                        name="last_name"
                        class="mt-1 w-full"
                        wire:model.lazy="state.last_name"
                        error="{{ $errors->first('last_name') }}"
                />
            </div>
            <!-- E-mail -->
            <div class="w-1/3">
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
            <!-- CPF -->
            <div class="w-1/2">
                <x-input
                        label="Número de CPF"
                        name="cpf"
                        class="mt-1 w-full"
                        wire:model.lazy="state.cpf"
                        error="{{ $errors->first('cpf') }}"
                />
            </div>
            <!-- Telefone -->
            <div class="w-1/2">
                <x-input
                        label="Número de Telefone"
                        name="phone"
                        class="mt-1 w-full"
                        wire:model.lazy="state.phone"
                        error="{{ $errors->first('phone') }}"
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
            <x-input-row class="mb-6 items-center">
                <h2 class="text-lg uppercase tracking-widest">Permissões de acesso (Papel)</h2>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
            </x-input-row>

            <x-input-row class="mb-6">
                <div class="flex justify-between w-2/4">
                    @foreach(\App\Models\Role::all() as $role)
                        <label class="flex items-center space-x-3">
                            <input
                                    type="radio"
                                    name="role"
                                    wire:model.lazy="state.role"
                                    value="{{ $role->id }}"
                                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                            >
                            <span>{{ $role->label }}</span>
                        </label>
                    @endforeach
                </div>
            </x-input-row>

            @error('role')
            <x-alert type="danger" :autoclose="false" message="{{ $message }}"></x-alert>
            @enderror

            @include('partials.role-description')
        @endif

        <x-input-row class="mt-6">
            <x-button type="button" wire:click="createUser">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="createUser(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
        </x-input-row>

    </form>
</x-card>
