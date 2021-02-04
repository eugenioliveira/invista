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
                        name="firstname"
                        class="mt-1 w-full"
                        wire:model.lazy="person.firstname"
                        error="{{ $errors->first('person.firstname') }}"
                />
            </div>
            <!-- Sobrenome -->
            <div class="w-1/3">
                <x-input
                        label="Sobrenome"
                        name="lastname"
                        class="mt-1 w-full"
                        wire:model.lazy="person.lastname"
                        error="{{ $errors->first('person.lastname') }}"
                />
            </div>
            <!-- E-mail -->
            <div class="w-1/3">
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
                        wire:model.lazy="person.cpf"
                        error="{{ $errors->first('person.cpf') }}"
                />
            </div>
            <!-- Telefone -->
            <div class="w-1/2">
                <x-input
                        label="Número de Telefone"
                        name="phone"
                        class="mt-1 w-full"
                        wire:model.lazy="person.phone"
                        error="{{ $errors->first('person.phone') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- CEP -->
            <div class="w-1/2">
                <x-input
                        label="CEP de residência"
                        name="postal_code"
                        class="mt-1 w-full"
                        wire:model="address.postal_code"
                        wire:blur="getAddressByPostalCode"
                        error="{{ $errors->first('address.postal_code') }}"
                />
            </div>
            <!-- Logradouro -->
            <div class="w-1/2">
                <x-input
                        label="Logradouro"
                        name="street"
                        class="mt-1 w-full"
                        wire:model.lazy="address.street"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.street') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- Número -->
            <div class="w-1/5">
                <x-input
                        label="Número"
                        name="number"
                        class="mt-1 w-full"
                        wire:model.lazy="address.number"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.number') }}"
                />
            </div>
            <!-- Complemento -->
            <div class="w-2/5">
                <x-input
                        label="Complemento"
                        name="apt_room"
                        class="mt-1 w-full"
                        wire:model.lazy="address.apt_room"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.apt_room') }}"
                />
            </div>
            <!-- Bairro -->
            <div class="w-2/5">
                <x-input
                        label="Bairro"
                        name="neighbourhood"
                        class="mt-1 w-full"
                        wire:model.lazy="address.neighbourhood"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.neighbourhood') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- Cidade -->
            <div class="w-1/2">
                <x-input
                        label="Cidade"
                        name="city"
                        class="mt-1 w-full"
                        wire:model.lazy="address.city"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.city') }}"
                />
            </div>
            <!-- Estado -->
            <div class="w-1/2">
                <x-input
                        label="Estado"
                        name="state"
                        class="mt-1 w-full"
                        wire:model.lazy="address.state"
                        wire:loading.delay.attr="disabled"
                        wire:target="getAddressByPostalCode"
                        error="{{ $errors->first('address.state') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mt-6">
            <x-button type="button" wire:click="saveUser">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="saveUser(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
        </x-input-row>
    </form>
</x-card>
