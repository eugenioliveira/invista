@php
    /** @var \App\Models\City $city */
    /** @var \App\Models\Allotment $allotment */
@endphp
<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <x-input-row class="mb-6 items-center">
            <h2 class="text-lg uppercase tracking-widest">Informações básicas</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-4">
            {{-- Título --}}
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
            {{-- Cidade --}}
            <div class="w-2/4 flex items-end space-x-2">
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
                <livewire:cities-modal />
            </div>
            {{-- Ativo --}}
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
            {{-- Área --}}
            <div class="w-1/5">
                <x-input
                    label="Área total (m²)"
                    name="area"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.area"
                    error="{{ $errors->first('allotment.area') }}"
                />
            </div>
            {{-- Latitude --}}
            <div class="w-2/5">
                <x-input
                    label="Latitude"
                    name="latitude"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.latitude"
                    error="{{ $errors->first('allotment.latitude') }}"
                />
            </div>
            {{-- Longitude --}}
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
            {{-- Desconto --}}
            <div class="w-2/4">
                <x-input
                    label="Desconto permitido (%)"
                    name="max_discount"
                    class="mt-1 w-full"
                    wire:model.lazy="allotment.max_discount"
                    error="{{ $errors->first('allotment.max_discount') }}"
                />
            </div>
            {{-- Margem --}}
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
        <x-input-row class="mb-6">
            {{-- Parcelamento Sinal --}}
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
        <x-input-row class="mb-4 items-center">
            <h2 class="text-lg uppercase tracking-widest">Imagem de Capa</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <div class="mb-6">
            <div
                class="mt-2 mb-4"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                {{-- File Input --}}
                <input type="file" wire:model="cover" accept="image/*">

                <div class="mt-4">

                    {{-- Mensagens de erro - Validação --}}
                    <div>
                        @error('cover')
                        <x-alert type="danger" message="{{ $message }}" :autoclose="false"/>
                        @enderror
                    </div>
                {{-- /End mensagens --}}

                    {{-- Progress Bar --}}
                    <div x-show="isUploading">
                        <div class="flex items-center">
                            <svg class="animate-spin mr-2 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <p class="text-sm">Fazendo upload...</p>
                        </div>
                        <progress class="w-full" max="100" x-bind:value="progress"></progress>
                    </div>
                    {{-- /End Progress Bar --}}

                    {{-- Imagem --}}
                    @if($cover)
                        @if($tempUrl)
                            <div class="bg-gray-200 p-4 rounded border-2 border-gray-500">
                                <h1 class="font-medium text-lg mb-4">Pré-visualizar imagem</h1>
                                <img class="w-full h-64 object-cover rounded-lg" src="{{ $tempUrl }}" alt="temp">
                            </div>
                        @endif
                    @elseif($allotment->cover)
                        <div class="bg-gray-200 p-4 rounded border-2 border-gray-500">
                            <h1 class="font-medium text-lg mb-4">Imagem de capa atual</h1>
                            <img class="w-full h-64 object-cover rounded-lg" src="{{ Storage::url($allotment->cover) }}" alt="foto de capa">
                        </div>
                    @else
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                            <p class="font-bold">Nada aqui</p>
                            <p>Nenhuma foto de capa cadastrada ainda. Clique no botão acima para fazer upload.</p>
                        </div>
                @endif
                {{-- /End imagem --}}

                </div>
            </div>
        </div>
        <x-input-row class="mt-6">
            <x-button type="button" wire:click="submit">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="submit(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('allotments.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>
</x-card>
