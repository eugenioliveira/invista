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
            <!-- Nome -->
            <div class="w-1/2">
                <x-input
                        label="Nome completo"
                        name="name"
                        class="mt-1 w-full"
                        wire:model.lazy="user.name"
                        error="{{ $errors->first('user.name') }}"
                />
            </div>
            <!-- E-mail -->
            <div class="w-1/2">
                <x-input
                        label="E-mail"
                        name="email"
                        class="mt-1 w-full"
                        wire:model.lazy="user.email"
                        error="{{ $errors->first('user.email') }}"
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
                        wire:model.lazy="passwordState.password"
                        error="{{ $errors->first('passwordState.password') }}"
                />
            </div>

            <!-- Confirmar senha -->
            <div class="w-1/2">
                <x-password-input
                        label="Confirmar senha"
                        name="password_confirmation"
                        class="mt-1 w-full"
                        wire:model.lazy="passwordState.password_confirmation"
                        error="{{ $errors->first('passwordState.password_confirmation') }}"
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
                                    name="roleId"
                                    wire:model.lazy="roleId"
                                    value="{{ $role->id }}"
                                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                            >
                            <span>{{ $role->label }}</span>
                        </label>
                    @endforeach
                </div>
            </x-input-row>
        @endif

        @include('partials.role-description')

        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Outras informações</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- CPF -->
            <div class="w-1/2">
                <x-input
                        label="Número de CPF"
                        name="cpf"
                        class="mt-1 w-full"
                        wire:model.lazy="detail.cpf"
                        error="{{ $errors->first('detail.cpf') }}"
                />
            </div>
            <!-- Telefone -->
            <div class="w-1/2">
                <x-input
                        label="Número de Telefone"
                        name="phone"
                        class="mt-1 w-full"
                        wire:model.lazy="detail.phone"
                        error="{{ $errors->first('detail.phone') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- Endereço -->
            <div class="w-full">
                <x-textarea
                        label="Endereço completo"
                        name="address"
                        class="mt-1 w-full h-32"
                        wire:model.lazy="detail.address"
                        error="{{ $errors->first('detail.address') }}"
                >
                </x-textarea>
            </div>
        </x-input-row>

        <x-input-row class="mt-6">
            <x-button type="button" wire:click="saveUser">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="saveUser(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('users.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>
</x-card>
