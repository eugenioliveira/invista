<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form wire:submit.prevent="submit">
        <x-input-row class="mb-4">
            {{-- Nome --}}
            <div class="w-full">
                <x-input
                        label="Nome"
                        name="name"
                        class="mt-1 w-full"
                        wire:model.lazy="state.name"
                        error="{{ $errors->first('state.name') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4">
            {{-- Descrição --}}
            <div class="w-full">
                <x-textarea
                        label="Descrição"
                        name="description"
                        class="mt-1 w-full"
                        wire:model.lazy="state.description"
                        error="{{ $errors->first('state.description') }}"
                >
                </x-textarea>
            </div>
        </x-input-row>

        <x-input-row class="mb-4 items-center">
            <h2 class="text-lg uppercase tracking-widest">Imagem de Fundo</h2>
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
                <input type="file" wire:model="image" accept="image/*" />

                <div class="mt-4">

                    {{-- Mensagens de erro - Validação --}}
                    <div>
                        @error('image')
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
                    @if($image)
                        @if($tempUrl)
                            <div class="bg-gray-200 p-4 rounded border-2 border-gray-500">
                                <h1 class="font-medium text-lg mb-4">Pré-visualizar imagem</h1>
                                <img class="w-full h-64 object-cover rounded-lg" src="{{ $tempUrl }}" alt="temp">
                            </div>
                        @endif
                    @elseif($state['image'])
                        <div class="bg-gray-200 p-4 rounded border-2 border-gray-500">
                            <h1 class="font-medium text-lg mb-4">Imagem de capa atual</h1>
                            <img class="w-full h-64 object-cover rounded-lg" src="{{ Storage::disk('maps')->url($state['image']) }}" alt="Imagem de fundo do mapa">
                        </div>
                    @else
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                            <p class="font-bold">Nada aqui</p>
                            <p>Nenhuma imagem de fundo cadastrada ainda. Clique no botão acima para fazer upload.</p>
                        </div>
                    @endif
                    {{-- /End imagem --}}

                </div>
            </div>
        </div>

        <x-input-row>
            <x-button>Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updateMap(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('allotments.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>
