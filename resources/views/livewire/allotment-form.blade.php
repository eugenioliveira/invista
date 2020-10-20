@php
    /** @var \App\Models\City $city */
    /** @var \App\Models\Allotment $allotment */
@endphp
<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}" />
    @endif

    <form wire:submit.prevent="submit">
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Título -->
            <div class="w-full">
                <x-input
                    label="Título"
                    name="title"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.title"
                    error="{{ $errors->first('allotment.title') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Cidade -->
            <div class="w-2/4">
                <x-select
                    label="Cidade"
                    name="city"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.city_id"
                    error="{{ $errors->first('allotment.city_id') }}"
                >
                    <option>Selecione...</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->full_name }}</option>
                    @endforeach
                </x-select>
            </div>
            <!-- Ativo -->
            <div class="w-2/4">
                <x-select
                    label="Ativo?"
                    name="active"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.active"
                    error="{{ $errors->first('allotment.active') }}"
                >
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </x-select>
            </div>
        </x-input-row>
        <x-input-row class="mb-6">
            <!-- Área -->
            <div class="w-1/5">
                <x-input
                    label="Área total (m²)"
                    name="area"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.area"
                    error="{{ $errors->first('allotment.area') }}"
                />
            </div>
            <!-- Latitude -->
            <div class="w-2/5">
                <x-input
                    label="Latitude"
                    name="latitude"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.latitude"
                    error="{{ $errors->first('allotment.latitude') }}"
                />
            </div>
            <!-- Longitude -->
            <div class="w-2/5">
                <x-input
                    label="Longitude"
                    name="longitude"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.longitude"
                    error="{{ $errors->first('allotment.longitude') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Regras de negócio</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Desconto -->
            <div class="w-2/4">
                <x-input
                    label="Desconto permitido (%)"
                    name="max_discount"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.max_discount"
                    error="{{ $errors->first('allotment.max_discount') }}"
                />
            </div>
            <!-- Margem -->
            <div class="w-2/4">
                <x-input
                    label="Margem máxima de desconto (%)"
                    name="allowable_margin"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.allowable_margin"
                    error="{{ $errors->first('allotment.allowable_margin') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mb-4">
            <!-- Parcelamento Sinal -->
            <div class="w-2/4">
                <x-input
                    label="Parcelamento máximo do arras (sinal)"
                    name="assurance_parcels"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.assurance_parcels"
                    error="{{ $errors->first('allotment.assurance_parcels') }}"
                />
            </div>
            <div class="w-2/4">
                <x-input
                    label="Duração da reserva (em horas)"
                    name="reservation_duration"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.reservation_duration"
                    error="{{ $errors->first('allotment.reservation_duration') }}"
                />
            </div>
        </x-input-row>
        <x-input-row class="mt-6">
            <x-button>Salvar e Voltar</x-button>
            <x-button type="button" wire:click="submit(false)">Salvar e Continuar</x-button>
        </x-input-row>
    </form>
</x-card>
