<div>

    <livewire:search-person-dropdown :exclude="$shareholders->pluck('id')"/>

    @if ($shareholders->isNotEmpty())
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    CPF
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Telefone
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Usuário do sistema?
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Cadastro completo?
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Possui endereço?
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($shareholders as $key => $person)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $person->cpf }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $person->full_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">{{ $person->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if($person->user)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Sim
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Não
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if($person->detail)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Sim
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Não
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @if($person->address)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Sim
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Não
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        {{-- Edit action --}}
                                        <x-button-link href="{{ route('person.edit', $person->id) }}" format="icon" title="Editar">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </x-button-link>
                                        {{-- Edit detail action --}}
                                        <x-button-link href="{{ route('person.detail', $person->id) }}" format="icon" title="Editar detalhes">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path>
                                            </svg>
                                        </x-button-link>
                                        {{-- Edit address action --}}
                                        <x-button-link href="{{ route('person.address', $person->id) }}" format="icon" title="Editar endereço">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </x-button-link>
                                        {{-- Remove shareholder --}}
                                        <x-button-link href="#" wire:click="removeShareholder({{ $key }})" type="danger" format="icon" title="Remover sócio">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </x-button-link>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- More rows... --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="px-4 py-3 leading-normal text-orange-100 bg-orange-400 rounded-lg" role="alert">
            <p>Nenhum sócio para esta empresa.</p>
        </div>
    @endif

    <x-card class="p-4 my-2">
        <x-input-row class="flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updateShareholders">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updateShareholders(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('companies.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </x-card>

</div>
