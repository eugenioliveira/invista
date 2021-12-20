<x-input-row class="space-y-3 md:space-y-0 md:mb-4">
    {{-- Primeiro Nome --}}
    <div class="md:w-1/2">
        <x-input
                label="Primeiro nome"
                name="first_name"
                class="mt-1 w-full"
                wire:model.defer="state.first_name"
                error="{{ $errors->first('first_name') }}"
        />
    </div>
    {{-- Sobrenome --}}
    <div class="md:w-1/2">
        <x-input
                label="Sobrenome"
                name="last_name"
                class="mt-1 w-full"
                wire:model.defer="state.last_name"
                error="{{ $errors->first('last_name') }}"
        />
    </div>
</x-input-row>

<x-input-row class="space-y-3 md:space-y-0 md:mb-4">
    {{-- CPF --}}
    <div class="md:w-1/2">
        <x-input
                label="Número de CPF"
                name="cpf"
                class="mt-1 w-full"
                wire:model.defer="state.cpf"
                error="{{ $errors->first('cpf') }}"
        />
    </div>
    {{-- Telefone --}}
    <div class="md:w-1/2">
        <x-input
                label="Número de Telefone (com DDD)"
                name="phone"
                class="mt-1 w-full"
                wire:model.defer="state.phone"
                error="{{ $errors->first('phone') }}"
        />
    </div>
</x-input-row>