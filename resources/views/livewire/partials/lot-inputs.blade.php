<x-input-row class="mb-6 items-center">
    <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
    <div class="flex-1 h-0.5 bg-gray-200"></div>
</x-input-row>
<x-input-row class="mb-4">
    {{-- Quadra --}}
    <div class="w-1/4">
        <x-input
            label="Quadra"
            name="block"
            class="mt-1 w-full"
            wire:model.lazy="lot.block"
            error="{{ $errors->first('lot.block') }}"
        />
    </div>
    {{-- Lote --}}
    <div class="w-1/4">
        <x-input
            label="Número do lote"
            name="number"
            class="mt-1 w-full"
            wire:model.lazy="lot.number"
            error="{{ $errors->first('lot.number') }}"
        />
    </div>
    {{-- Preço --}}
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
    {{-- Área total --}}
    <div class="w-1/2">
        <x-input
                label="Área total (metros)"
                name="total"
                class="mt-1 w-full"
                wire:model.lazy="lot.total"
                error="{{ $errors->first('lot.total') }}"
        />
    </div>
    {{-- Curvatura --}}
    <div class="w-1/2">
        <x-input
                label="Curvatura (metros)"
                name="curve"
                class="mt-1 w-full"
                wire:model.lazy="lot.curve"
                error="{{ $errors->first('lot.curve') }}"
        />
    </div>
</x-input-row>
<x-input-row class="mb-4">
    {{-- Frente --}}
    <div class="w-1/4">
        <x-input
            label="Frente (metros)"
            name="front"
            class="mt-1 w-full"
            wire:model.lazy="lot.front"
            error="{{ $errors->first('lot.front') }}"
        />
    </div>
    {{-- Fundos --}}
    <div class="w-1/4">
        <x-input
            label="Fundos (metros)"
            name="back"
            class="mt-1 w-full"
            wire:model.lazy="lot.back"
            error="{{ $errors->first('lot.back') }}"
        />
    </div>
    {{-- Direita --}}
    <div class="w-1/4">
        <x-input
            label="Direita (metros)"
            name="right"
            class="mt-1 w-full"
            wire:model.lazy="lot.right"
            error="{{ $errors->first('lot.right') }}"
        />
    </div>
    {{-- Esquerda --}}
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
    {{-- Frente --}}
    <div class="w-1/2">
        <x-input
            label="Frente"
            name="front_side"
            class="mt-1 w-full"
            wire:model.lazy="lot.front_side"
            error="{{ $errors->first('lot.front_side') }}"
        />
    </div>
    {{-- Fundos --}}
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
    {{-- Direita --}}
    <div class="w-1/2">
        <x-input
            label="Direita"
            name="right_side"
            class="mt-1 w-full"
            wire:model.lazy="lot.right_side"
            error="{{ $errors->first('lot.right_side') }}"
        />
    </div>
    {{-- Esquerda --}}
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
