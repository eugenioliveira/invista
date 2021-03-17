<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            {{-- CEP --}}
            <div class="md:w-1/2">
                <x-input
                        label="CEP de residência"
                        name="postal_code"
                        class="mt-1 w-full"
                        wire:model.lazy="state.postal_code"
                        wire:blur="fillAddressFromPostalCode"
                        error="{{ $errors->first('postal_code') }}"
                />
            </div>
            {{-- Logradouro --}}
            <div class="md:w-1/2">
                <x-input
                        label="Logradouro"
                        name="street"
                        class="mt-1 w-full"
                        wire:model.lazy="state.street"
                        error="{{ $errors->first('street') }}"
                        :block="$blockFields"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            {{-- Número --}}
            <div class="md:w-1/5">
                <x-input
                        label="Número"
                        name="number"
                        class="mt-1 w-full"
                        wire:model.lazy="state.number"
                        error="{{ $errors->first('number') }}"
                        :block="$blockFields"
                />
            </div>
            {{-- Complemento --}}
            <div class="md:w-2/5">
                <x-input
                        label="Complemento"
                        name="apt_room"
                        class="mt-1 w-full"
                        wire:model.lazy="state.apt_room"
                        error="{{ $errors->first('apt_room') }}"
                        :block="$blockFields"
                />
            </div>
            {{-- Bairro --}}
            <div class="md:w-2/5">
                <x-input
                        label="Bairro"
                        name="neighbourhood"
                        class="mt-1 w-full"
                        wire:model.lazy="state.neighbourhood"
                        error="{{ $errors->first('neighbourhood') }}"
                        :block="$blockFields"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            {{-- Cidade --}}
            <div class="md:w-1/2">
                <x-input
                        label="Cidade"
                        name="city"
                        class="mt-1 w-full"
                        wire:model.lazy="state.city"
                        error="{{ $errors->first('city') }}"
                        :block="$blockFields"
                />
            </div>
            {{-- Estado --}}
            <div class="md:w-1/2">
                <x-input
                        label="Estado"
                        name="state"
                        class="mt-1 w-full"
                        wire:model.lazy="state.state"
                        error="{{ $errors->first('state') }}"
                        :block="$blockFields"
                />
            </div>
        </x-input-row>

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updateAddress">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="udpateAddress(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>