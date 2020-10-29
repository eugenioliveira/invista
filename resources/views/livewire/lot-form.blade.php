<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form wire:submit.prevent="submit">
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Quadra -->
            <div class="w-1/4">
                <x-input
                    label="Quadra"
                    name="block"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.block"
                    error="{{ $errors->first('lot.block') }}"
                />
            </div>
            <!-- Lote -->
            <div class="w-1/4">
                <x-input
                    label="Número do lote"
                    name="number"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.number"
                    error="{{ $errors->first('lot.number') }}"
                />
            </div>
            <!-- Preço -->
            <div class="w-2/4">
                <x-input
                    label="Preço (R$)"
                    name="price"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.price"
                    error="{{ $errors->first('lot.price') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Metragem</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Frente -->
            <div class="w-1/4">
                <x-input
                    label="Frente (metros)"
                    name="front"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.front"
                    error="{{ $errors->first('lot.front') }}"
                />
            </div>
            <!-- Fundos -->
            <div class="w-1/4">
                <x-input
                    label="Fundos (metros)"
                    name="back"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.back"
                    error="{{ $errors->first('lot.back') }}"
                />
            </div>
            <!-- Direita -->
            <div class="w-1/4">
                <x-input
                    label="Direita (metros)"
                    name="right"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.right"
                    error="{{ $errors->first('lot.right') }}"
                />
            </div>
            <!-- Esquerda -->
            <div class="w-1/4">
                <x-input
                    label="Esquerda (metros)"
                    name="front"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.left"
                    error="{{ $errors->first('lot.left') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Confrontações</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Frente -->
            <div class="w-1/2">
                <x-input
                    label="Frente"
                    name="front_side"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.front_side"
                    error="{{ $errors->first('lot.front_side') }}"
                />
            </div>
            <!-- Fundos -->
            <div class="w-1/2">
                <x-input
                    label="Fundos"
                    name="back_side"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.back_side"
                    error="{{ $errors->first('lot.back_side') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Direita -->
            <div class="w-1/2">
                <x-input
                    label="Direita"
                    name="right_side"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.right_side"
                    error="{{ $errors->first('lot.right_side') }}"
                />
            </div>
            <!-- Esquerda -->
            <div class="w-1/2">
                <x-input
                    label="Esquerda"
                    name="left_side"
                    class="mt-1 w-full"
                    wire:model.lazy="lot.left_side"
                    error="{{ $errors->first('lot.left_side') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-6">
            <h2 class="text-lg uppercase tracking-widest">Status inicial</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-6">
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::AVAILABLE }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::AVAILABLE()->description }}</span>
            </label>
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::BLOCKED }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::BLOCKED()->description }}</span>
            </label>
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::SOLD }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::SOLD()->description }}</span>
            </label>
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::PARTNER }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::PARTNER()->description }}</span>
            </label>
            @error('statusType')
                <div class="mt-1 flex items-center">
                    <span class="font-medium text-red-500 text-xs">{{ $message }}</span>
                </div>
            @enderror
        </x-input-row>
        <x-input-row>
            <x-button>Salvar e Voltar</x-button>
            <x-button type="button" wire:click="submit(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('lots.index', $allotmentId) }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>
