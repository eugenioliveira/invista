<div>

    <div class="flex justify-center mb-2 space-x-2 items-end">
        <x-input.group :inline="true" for="postal_code" label="CEP" :error="$errors->first('postal_code') ? $errors->first('postal_code') : $errors->first('state.address.postal_code')">
            <x-input.text wire:model.lazy="state.address.postal_code" id="postal_code" autocomplete="off"
                          placeholder="CEP" />
        </x-input.group>
        <x-button wire:click="findAddressByCEP" type="button">Preencher</x-button>
    </div>

    <x-input.group for="street" label="Logradouro" :error="$errors->first('state.address.street')">
        <x-input.text wire:model.lazy="state.address.street" id="street" placeholder="Digite o logradouro" />
    </x-input.group>

    <x-input.group for="number" label="Número" :error="$errors->first('state.address.number')">
        <x-input.text wire:model.lazy="state.address.number" id="number" placeholder="Digite o número" />
    </x-input.group>

    <x-input.group for="apt_room" label="Complemento" :error="$errors->first('state.address.apt_room')">
        <x-input.text wire:model.lazy="state.address.apt_room" id="apt_room" placeholder="Digite o complemento (opcional)" />
    </x-input.group>

    <x-input.group for="neighbourhood" label="Bairro" :error="$errors->first('state.address.neighbourhood')">
        <x-input.text wire:model.lazy="state.address.neighbourhood" id="neighbourhood" placeholder="Digite o bairro" />
    </x-input.group>

    <x-input.group for="city" label="Cidade" :error="$errors->first('state.address.city')">
        <x-input.text wire:model.lazy="state.address.city" id="city" placeholder="Digite a cidade" />
    </x-input.group>

    <x-input.group for="state" label="Estado" :error="$errors->first('state.address.state')">
        <x-input.text wire:model.lazy="state.address.state" id="state" placeholder="Digite a UF" />
    </x-input.group>
</div>