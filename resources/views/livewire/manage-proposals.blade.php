<div>
    <div class="p-2 md:p-0 space-y-4">

        <div>
            @if(!$lot && !$proposal)
                <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-x-3">
                    <div class="md:w-1/3">
                        <x-input.text wire:model="search" placeholder="Buscar por Loteamento, Corretor ou Cliente..." />
                    </div>
                    <div class='flex space-x-2 items-center justify-center'>
                        <x-input.checkbox wire:model='active' />
                        <span>Mostrar apenas propostas ativas</span>
                    </div>
                    <div class='w-full md:w-1/4'>
                        <x-button type='button' class="w-full inline-flex justify-center" wire:click="$toggle('showAdvancedFilters')">
                            @if ($showAdvancedFilters) Esconder @else Mostrar @endif filtros avançados
                        </x-button>
                    </div>
                </div>
            @endif
        </div>

        <div>
            @if ($showAdvancedFilters)
                <div class='bg-gray-200 rounded shadow p-4 md:px-6 md:py-4'>
                    <div class='flex flex-col space-y-4 md:space-y-0 md:flex-row md:justify-around'>
                        <div class='md:w-1/3 divide-y divide-gray-500 space-y-3'>
                            <p class='text-gray-700 font-bold'>Filtrar pela data da proposta</p>
                            <div class='flex space-x-2 pt-2'>
                                <x-input.group inline for="filter-created-at-min" label="Data mínima">
                                    <x-input.date wire:model="filters.created-at-min" id="filter-created-at-min"
                                                  placeholder="DD/MM/AAAA" />
                                </x-input.group>
                                <x-input.group inline for="filter-created-at-max" label="Data máxima">
                                    <x-input.date wire:model="filters.created-at-max" id="filter-created-at-max"
                                                  placeholder="DD/MM/AAAA" />
                                </x-input.group>
                            </div>
                        </div>
                        <div class='md:w-1/3 divide-y divide-gray-500 space-y-3'>
                            <p class='text-gray-700 font-bold'>Filtrar pelo tipo de proposta</p>
                            <div class='pt-2'>
                                <x-input.group inline for="filter-type" label="Tipo">
                                    <x-input.select class="w-full" wire:model="filters.type" id="filter-type"
                                                  placeholder="Selecione...">
                                        @foreach(\App\Enums\ProposalType::getInstances() as $proposalType)
                                            <option value="{{ $proposalType->value }}">{{ $proposalType->description }}</option>
                                        @endforeach
                                    </x-input.select>
                                </x-input.group>
                            </div>
                        </div>
                    </div>
                    <div class='flex justify-end pt-4'>
                        <x-button type='text' wire:click='resetFilters'>Resetar filtros</x-button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tabela -->
        <div class="flex flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>Loteamento</x-table.heading>
                    <x-table.heading>Lote</x-table.heading>
                    <x-table.heading>Corretor</x-table.heading>
                    <x-table.heading>Cliente</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('type')"
                                     :direction="$sortField === 'type' ? $sortDirection : null">Tipo</x-table.heading>
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('created_at')"
                                     :direction="$sortField === 'created_at' ? $sortDirection : null">Data</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse($proposals as $proposal)
                        <x-table.row>
                            <x-table.cell>{{ $proposal->lot->allotment->title }}</x-table.cell>
                            <x-table.cell>{{ $proposal->lot->identification }}</x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ $proposal->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $proposal->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $proposal->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $proposal->proposeable->full_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    CPF: {{ $proposal->proposeable->cpf }}
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div>
                                    {{ $proposal->type->description }}
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <x-proposal-status-badge :status="$proposal->latestStatus->type"></x-proposal-status-badge>
                            </x-table.cell>
                            <x-table.cell>
                                {{ $proposal->created_at->format('d/m/Y H:i') }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class='flex space-x-2'>
                                    <div>
                                        <x-button-link href="{{ route('proposal.show', $proposal->id) }}" target='_blank' format="icon" title="Ver proposta">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </x-button-link>
                                    </div>
                                    <div>
                                        <x-button type="button" wire:click="showResolveProposal({{ $proposal->id }})"  format="icon" title="Resolver proposta">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd" />
                                            </svg>
                                        </x-button>
                                    </div>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan='7'>
                                <div class='flex justify-center items-center space-x-2 text-gray-500'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <span class='text-lg'>Nenhuma proposta encontrada.</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>

    <x-imodal.dialog wire:model.defer="showResolveProposalModal">
        <x-slot name="title">Ver proposta</x-slot>
        <x-slot name="content"></x-slot>
        <x-slot name="footer">
            <x-button wire:click="$set('showProposalModal', false)">Fechar</x-button>
        </x-slot>
    </x-imodal.dialog>
</div>
