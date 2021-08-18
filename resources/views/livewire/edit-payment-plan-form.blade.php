<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            {{-- Nome --}}
            <div class="md:w-1/2">
                <x-input
                        label="Nome"
                        name="name"
                        class="mt-1 w-full"
                        wire:model.defer="state.name"
                        error="{{ $errors->first('name') }}"
                />
            </div>
            {{-- Sobrenome --}}
            <div class="md:w-1/2">
                <x-input
                        label="Entrada mínima (%)"
                        name="min_down_payment"
                        class="mt-1 w-full"
                        wire:model.defer="state.min_down_payment"
                        error="{{ $errors->first('min_down_payment') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            {{-- Nome --}}
            <div class="w-full">
                <x-input
                        label="Descrição"
                        name="name"
                        class="mt-1 w-full"
                        wire:model.defer="state.description"
                        error="{{ $errors->first('description') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="mb-4 items-center">
            <h2 class="text-lg uppercase tracking-widest">Índices de parcelamento</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 w-1/3 font-medium text-gray-500 uppercase tracking-wider">
                    Parcelas
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 w-1/3 font-medium text-gray-500 uppercase tracking-wider">
                    Índice
                </th>
                <th class="px-6 py-3 bg-gray-50 w-1/3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($installmentIndexes as $key => $row)
                <tr>
                    {{-- Installments --}}
                    @if($row == $indexState)
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <input wire:model.defer="indexState.installments"
                                   class="border border-gray-400 w-full p-1 rounded"
                            />
                        </td>
                        {{-- Index --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <input wire:model.defer="indexState.index"
                                   class="border border-gray-400 w-full p-1 rounded"
                            />
                        </td>
                    @else
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $row['installments'] }}
                        </td>
                        {{-- Index --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $row['index'] }}
                        </td>
                    @endif
                    {{-- Actions --}}
                    <td class="px-6 py-4 flex space-x-1">
                        @if($row == $indexState)
                            {{-- Apply action --}}
                            <x-button type="button" title="Aplicar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </x-button>
                            {{-- Cancel action --}}
                            <x-button type="button" wire:click="clearIndexState" title="Cancelar">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </x-button>
                        @else
                            {{-- Edit action --}}
                            <x-button type="button" wire:click="editIndex({{$key}})" title="Editar">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </x-button>
                            {{-- Delete action --}}
                            <x-button type="button" wire:click="deleteIndex({{$key}})" title="Excluir">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </x-button>
                        @endif
                    </td>
                </tr>
            @endforeach

            {{-- More rows... --}}
            </tbody>
        </table>

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updatePerson">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updatePerson(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('people.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>