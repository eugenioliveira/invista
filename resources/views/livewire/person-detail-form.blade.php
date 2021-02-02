<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Estado Civil -->
            <div class="md:w-1/4">
                <x-select
                        label="Estado civil"
                        name="civil_status"
                        class="mt-1 w-full"
                        wire:model.lazy="state.civil_status"
                        error="{{ $errors->first('civil_status') }}"
                >
                    @foreach(\App\Enums\CivilStatus::getInstances() as $status)
                        <option value="{{ $status->value }}">{{ $status->description }}</option>
                    @endforeach
                </x-select>
            </div>
            <!-- Data de nascimento -->
            <div class="md:w-1/4">
                <x-input
                        label="Data de nascimento"
                        name="birth_date"
                        class="mt-1 w-full"
                        wire:model.lazy="state.birth_date"
                        error="{{ $errors->first('birth_date') }}"
                />
            </div>
            <!-- Naturalidade -->
            <div class="md:w-2/4">
                <x-input
                        label="Naturalidade"
                        name="birth_location"
                        class="mt-1 w-full"
                        wire:model.lazy="state.birth_location"
                        error="{{ $errors->first('birth_location') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Nacionalidade -->
            <div class="md:w-2/4">
                <x-input
                        label="Nacionalidade"
                        name="nationality"
                        class="mt-1 w-full"
                        wire:model.lazy="state.nationality"
                        error="{{ $errors->first('nationality') }}"
                />
            </div>
            <!-- RG -->
            <div class="md:w-1/4">
                <x-input
                        label="RG"
                        name="rg"
                        class="mt-1 w-full"
                        wire:model.lazy="state.rg"
                        error="{{ $errors->first('rg') }}"
                />
            </div>
            <!-- RG -->
            <div class="md:w-1/4">
                <x-input
                        label="Órgão emissor"
                        name="rg_issuer"
                        class="mt-1 w-full"
                        wire:model.lazy="state.rg_issuer"
                        error="{{ $errors->first('rg_issuer') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Profissão -->
            <div class="md:w-1/3">
                <x-input
                        label="Profissão"
                        name="occupation"
                        class="mt-1 w-full"
                        wire:model.lazy="state.occupation"
                        error="{{ $errors->first('occupation') }}"
                />
            </div>
            <!-- Profissão -->
            <div class="md:w-1/3">
                <x-input
                        label="E-mail"
                        name="email"
                        class="mt-1 w-full"
                        wire:model.lazy="state.email"
                        error="{{ $errors->first('email') }}"
                />
            </div>
            <!-- Profissão -->
            <div class="md:w-1/3">
                <x-input
                        label="Renda mensal (em R$)"
                        name="monthly_income"
                        class="mt-1 w-full"
                        wire:model.lazy="state.monthly_income"
                        error="{{ $errors->first('monthly_income') }}"
                />
            </div>
        </x-input-row>

        <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
            <!-- Nome do pai -->
            <div class="md:w-1/2">
                <x-input
                        label="Nome do pai"
                        name="father_name"
                        class="mt-1 w-full"
                        wire:model.lazy="state.father_name"
                        error="{{ $errors->first('father_name') }}"
                />
            </div>
            <!-- Nome da mãe -->
            <div class="md:w-1/2">
                <x-input
                        label="Nome da mãe"
                        name="mother_name"
                        class="mt-1 w-full"
                        wire:model.lazy="state.mother_name"
                        error="{{ $errors->first('mother_name') }}"
                />
            </div>
        </x-input-row>

        @if($state['civil_status'] == \App\Enums\CivilStatus::MARRIED)
            <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
                <h2 class="text-lg uppercase tracking-widest">Cônjuge</h2>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
            </x-input-row>

            @if($partner)
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cadastro completo?
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $partner->full_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $partner->cpf }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if($partner->detail)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Sim
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Não
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right text-sm font-medium">
                                            <!-- Edit action -->
                                            <x-button-link href="{{ route('person.edit', $partner->id) }}" format="icon" title="Editar">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </x-button-link>
                                            <!-- Edit detail action -->
                                            <x-button-link href="{{ route('person.detail', $partner->id) }}" format="icon"
                                                           title="Editar detalhes">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path>
                                                </svg>
                                            </x-button-link>
                                            <!-- Edit address action -->
                                            <x-button-link href="{{ route('person.address', $partner->id) }}" format="icon"
                                                           title="Editar endereço">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </x-button-link>
                                            <!-- Remove partner -->
                                            <x-button-link href="#" wire:click="unselectPartner" type="danger" format="icon" title="Remover cônjuge">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </x-button-link>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="my-4 text-red-500">
                    Nehum cônjuge cadastrado. Se o estado civil escolhido for casado(a), o cadastro de um cônjuge é obrigatório.
                </div>
                <label for="partner_search" class="text-sm font-medium">Busca de cônjuge</label>
                <div class="relative">
                    <input
                            type="text"
                            name="partner_search"
                            id="partner_search"
                            placeholder="Digite o nome ou CPF do cônjuge para buscar"
                            autocomplete="off"
                            wire:model.debounce.300ms="partnerSearch"
                            class="w-full border border-orange-500 pl-12 pr-4 py-2 rounded-lg"
                    />
                    <div class="absolute inset-y-0 left-0 ml-4 flex items-center text-orange-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    @if($partnerSearchResult)
                        <div class="absolute z-10 w-full px-4 py-2 mt-2 shadow rounded-lg bg-orange-50 border border-orange-500 divide-y divide-orange-500">
                            @forelse($partnerSearchResult as $key => $possiblePartner)
                                <div class="flex items-center">
                                    <div class="py-2">
                                        <a href="#" class="text-sm font-medium text-gray-900 hover:underline">
                                            {{ $possiblePartner->full_name }}
                                        </a>
                                        <div class="text-sm">
                                            CPF: {{ $possiblePartner->cpf }}
                                        </div>
                                    </div>
                                    <x-button type="button" wire:click.prevent="selectPartner({{ $key }})" class="ml-4">Selecionar</x-button>
                                </div>
                            @empty
                                <div>Nenhuma pessoa encontrada.</div>
                            @endforelse
                        </div>
                    @endif
                </div>
            @endif

        @endif

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="saveDetail">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="saveDetail(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('people.index') }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>