<div>
    <div class="p-2 md:p-0 space-y-4">
        <div>
            {{-- Success message --}}
            @if(session('successMessage'))
                <x-alert type="success" message="{{ session('successMessage') }}" />
            @endif
        </div>
        <div>
            @if(!$proposal)
                <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-x-3">
                    <div class="md:w-1/3">
                        <x-input.text wire:model="search" placeholder="Buscar por Loteamento, Corretor ou Cliente..." />
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
                    <x-table.heading>Valor da venda</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('created_at')"
                                     :direction="$sortField === 'created_at' ? $sortDirection : null">Data
                    </x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @forelse($sales as $sale)
                        <x-table.row>
                            <x-table.cell>{{ $sale->lot->allotment->title }}</x-table.cell>
                            <x-table.cell>{{ $sale->lot->identification }}</x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ $sale->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $sale->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $sale->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $sale->salable->full_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    CPF: {{ $sale->salable->cpf }}
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                R$ {{ $sale->value }}
                            </x-table.cell>
                            <x-table.cell>
                                {{ $sale->created_at->format('d/m/Y H:i') }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class='flex space-x-2'>
                                    <div>
                                        @if($sale->contract)
                                            <x-button-link
                                                    href="{{ \Storage::disk('documents')->url($sale->contract) }}"
                                                    target='_blank' format="icon" title="Baixar contrato">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                          clip-rule="evenodd" />
                                                </svg>
                                            </x-button-link>
                                        @endif
                                    </div>
                                    <div>
                                        @if(!$sale->contract)
                                            <x-button-link
                                                    href="{{ route('sales.addcontract', $sale->id) }}"
                                                    target='_blank' format="icon" title="Adicionar / Atualizar contrato">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </x-button-link>
                                        @endif
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
                                    <span class='text-lg'>Nenhuma venda encontrada.</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>

</div>
