@php
    /** @var \App\Models\Person $person */
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
            <div class="md:w-1/2">
                <x-input
                        label="Primeiro nome"
                        name="firstname"
                        class="mt-1 w-full"
                        wire:model.lazy="person.firstname"
                        error="{{ $errors->first('person.firstname') }}"
                />
            </div>
            <!-- Sobrenome -->
            <div class="md:w-1/2">
                <x-input
                        label="Sobrenome"
                        name="lastname"
                        class="mt-1 w-full"
                        wire:model.lazy="person.lastname"
                        error="{{ $errors->first('person.lastname') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- CPF -->
            <div class="md:w-1/2">
                <x-input
                        label="Número de CPF"
                        name="cpf"
                        class="mt-1 w-full"
                        wire:model.lazy="person.cpf"
                        error="{{ $errors->first('person.cpf') }}"
                />
            </div>
            <!-- Telefone -->
            <div class="md:w-1/2">
                <x-input
                        label="Número de Telefone"
                        name="phone"
                        class="mt-1 w-full"
                        wire:model.lazy="person.phone"
                        error="{{ $errors->first('person.phone') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Endereço</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <x-input-row class="mb-4">
            <!-- CEP -->
            <div class="md:w-1/2">
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
            <div class="md:w-1/2">
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
            <div class="md:w-1/5">
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
            <div class="md:w-2/5">
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
            <div class="md:w-2/5">
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
            <div class="md:w-1/2">
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
            <div class="md:w-1/2">
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

        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Informações complementares</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>


    </form>

</x-card>