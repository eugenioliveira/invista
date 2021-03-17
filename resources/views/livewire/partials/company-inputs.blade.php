<x-input-row class="space-y-3 md:space-y-0 md:mb-4">
    {{-- Nome da empresa --}}
    <div class="md:w-1/2">
        <x-input
                label="Nome da empresa"
                name="name"
                class="mt-1 w-full"
                wire:model.defer="state.name"
                error="{{ $errors->first('name') }}"
        />
    </div>
    {{-- CNPJ --}}
    <div class="md:w-1/2">
        <x-input
                label="CNPJ"
                name="cnpj"
                class="mt-1 w-full"
                wire:model.defer="state.cnpj"
                error="{{ $errors->first('cnpj') }}"
        />
    </div>
</x-input-row>

<x-input-row class="space-y-3 md:space-y-0 md:mb-4">
    {{-- Inscrição estadual --}}
    <div class="md:w-1/2">
        <x-input
                label="Inscrição estadual"
                name="state_reg_id"
                class="mt-1 w-full"
                wire:model.defer="state.state_reg_id"
                error="{{ $errors->first('state_reg_id') }}"
        />
    </div>
    {{-- Telefone --}}
    <div class="md:w-1/2">
        <x-input
                label="Telefone"
                name="phone"
                class="mt-1 w-full"
                wire:model.defer="state.phone"
                error="{{ $errors->first('phone') }}"
        />
    </div>
</x-input-row>