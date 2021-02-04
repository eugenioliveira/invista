@php
    /** @var \Illuminate\Support\Collection $lots */
@endphp

<x-section>
    <x-card class="p-4">
        <p>Esta funcionalidade permite que lotes sejam importados para determinado loteamento. Clique no botão "Escolher arquivo" para começar. Apenas arquivos
            do
            Excel (.xls ou .xlsx) são suportados.</p>
        <hr class="my-3">
        <form wire:submit.prevent="importLots" enctype="multipart/form-data">
            <div class="flex justify-center items-center mt-6">
                <input type="file" wire:model="importFile">
                <x-button wire:click="importLots" type="button">Ler lotes do arquivo</x-button>
            </div>

            <x-validation-errors class="my-3"/>

            @if($lots->isNotEmpty())
                <div class="relative" x-data="{ loading: @entangle('showLoading') }">
                    <div x-show="loading" class="bg-black bg-opacity-75 absolute inset-y-0 w-full"></div>
                    <div class="overflow-auto h-96 mt-6">
                        <table class="min-w-full divide-y divide-gray-200 mt-3">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Identificação
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Preço
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Frente (m<sup>2</sup>)
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Fundos (m<sup>2</sup>)
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Direita (m<sup>2</sup>)
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Esquerda (m<sup>2</sup>)
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($lots as $lot)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['identification'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['formatted_price'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['front'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['back'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['right'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $lot['left'] }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-input-row class="mt-2 items-end">
                    <div class="w-2/4">
                        <x-select
                            label="Se o lote já existir..."
                            name="shouldOverwrite"
                            class="mt-1 w-full"
                            wire:model.lazy="shouldOverwrite"
                        >
                            <option value="0">Adicionar novos e ignorar existentes</option>
                            <option value="1">Sobrescrever com os dados do arquivo</option>
                        </x-select>
                    </div>
                </x-input-row>
                <div class="flex items-center bg-blue-500 text-white text-sm px-4 py-3 mt-3 rounded-lg shadow" role="alert">
                    <div class="w-8">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                        </svg>
                    </div>
                    @if($shouldOverwrite)
                        <p>Caso haja no arquivo lotes existentes (Combinação quadra e número), os dados destes lotes serão atualizados com as informações
                            presentes
                            no
                            arquivo.</p>
                    @else
                        <p>Somente os lotes novos (Combinação quadra e número) serão adicionados. Os lotes existentes serão ignorados.</p>
                    @endif
                </div>
                <hr class="my-3">
                <div class="bg-gray-100">
                    <x-button type="button" wire:click="saveLots">Salvar lotes</x-button>
                    <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
                </div>
            @endif
        </form>
    </x-card>
</x-section>
