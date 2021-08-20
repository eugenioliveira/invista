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
                        name="description"
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
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 w-1/5 font-medium text-gray-500 uppercase tracking-wider">
                    Parcelas
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 w-1/5 font-medium text-gray-500 uppercase tracking-wider">
                    Índice
                </th>
                <th class="px-6 py-3 bg-gray-50 w-1/3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($indexes as $key => $index)
                <tr>
                    @if ($editingIndexKey !== $key)
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $index['installments'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $index['index'] }}
                        </td>
                    @else
                        <td class="px-6 py-4 whitespace-no-wrap w-1/5">
                            <div class="relative">
                                <input
                                        class="w-full border border-gray-400 py-1 px-2 rounded"
                                        name="installments"
                                        wire:model.defer="indexState.update.installments"
                                        value="{{ $index['installments'] }}"/>
                                {{-- Error popup --}}
                                @error('update.installments')
                                <x-error-popup>{{ $message }}</x-error-popup>
                                @enderror
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap w-1/5">
                            <input
                                    class="w-full border border-gray-400 py-1 px-2 rounded"
                                    name="index"
                                    wire:model.defer="indexState.update.index"
                                    value="{{ $index['index'] }}"/>
                            @error('update.index')
                            <x-error-popup>{{ $message }}</x-error-popup>
                            @enderror
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-no-wrap flex space-x-3">
                        @if ($editingIndexKey !== $key)
                            <x-button type="button" wire:click="editIndex({{ $key }})">
                                Editar
                            </x-button>
                            <x-button type="button" wire:click="deleteIndex({{ $key }})">
                                Excluir
                            </x-button>
                        @else
                            <x-button type="button" wire:click="updateIndex({{ $key }})">
                                Aplicar
                            </x-button>
                            <x-button type="button" wire:click="clearEditing">
                                Cancelar
                            </x-button>
                        @endif
                    </td>
                </tr>
            @endforeach

            {{-- More rows... --}}
            </tbody>
        </table>

        <hr class="my-6">

        <div class="space-y-3 md:space-y-0 md:flex md:items-center md:space-x-3">
            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                {{-- Nome --}}
                <div class="md:w-1/2">
                    <x-input
                            label="Nova parcela"
                            name="new-installment"
                            class="mt-1 w-full"
                            wire:model.defer="indexState.create.installments"
                            error="{{ $errors->first('create.installments') }}"
                    />
                </div>
                {{-- Sobrenome --}}
                <div class="md:w-1/2">
                    <x-input
                            label="Novo índice"
                            name="new-index"
                            class="mt-1 w-full"
                            wire:model.defer="indexState.create.index"
                            error="{{ $errors->first('create.index') }}"
                    />
                </div>
            </x-input-row>

            <x-button type="button" wire:click="createIndex()">
                Criar
            </x-button>
        </div>

        <hr class="my-6">

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="savePaymentPlan">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="savePaymentPlan(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('payment-plans.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>