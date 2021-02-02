<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- CEP -->
            <div class="md:w-1/2">
                <x-input
                        label="CEP de residência"
                        name="postal_code"
                        class="mt-1 w-full"
                        wire:model.lazy="state.postal_code"
                        wire:blur="fillAddressFromPostalCode()"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('postal_code') }}"
                />
            </div>
            <!-- Logradouro -->
            <div class="md:w-1/2">
                <x-input
                        label="Logradouro"
                        name="street"
                        class="mt-1 w-full"
                        wire:model.lazy="state.street"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('street') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Número -->
            <div class="md:w-1/5">
                <x-input
                        label="Número"
                        name="number"
                        class="mt-1 w-full"
                        wire:model.lazy="state.number"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('number') }}"
                />
            </div>
            <!-- Complemento -->
            <div class="md:w-2/5">
                <x-input
                        label="Complemento"
                        name="apt_room"
                        class="mt-1 w-full"
                        wire:model.lazy="state.apt_room"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('apt_room') }}"
                />
            </div>
            <!-- Bairro -->
            <div class="md:w-2/5">
                <x-input
                        label="Bairro"
                        name="neighbourhood"
                        class="mt-1 w-full"
                        wire:model.lazy="state.neighbourhood"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('neighbourhood') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Cidade -->
            <div class="md:w-1/2">
                <x-input
                        label="Cidade"
                        name="city"
                        class="mt-1 w-full"
                        wire:model.lazy="state.city"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('city') }}"
                />
            </div>
            <!-- Estado -->
            <div class="md:w-1/2">
                <x-input
                        label="Estado"
                        name="state"
                        class="mt-1 w-full"
                        wire:model.lazy="state.state"
                        wire:loading.attr="disabled"
                        wire:target="fillAddressFromPostalCode"
                        error="{{ $errors->first('state') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updateAddress">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="udpateAddress(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('people.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>