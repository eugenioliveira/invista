<div>
    <div class="p-2 md:p-0 space-y-4">
        <div>
            @if(!$lot)
                <div class="flex flex-col space-y-2 md:flex-row md:items-center md:space-x-3">
                    <div class="md:w-1/4">
                        <x-input.text wire:model="search" placeholder="Buscar por Loteamento, Corretor ou Cliente..." />
                    </div>
                    <div class='flex space-x-2 items-center justify-center'>
                        <x-input.checkbox wire:model='active' />
                        <span>Mostrar apenas reservas ativas</span>
                    </div>
                    <div class='w-full md:w-1/5'>
                        <x-button type='button' class="w-full inline-flex justify-center" wire:click="$toggle('showDateFilters')">
                            @if ($showDateFilters) Esconder @else Mostrar @endif busca por datas
                        </x-button>
                    </div>
                </div>
            @endif
        </div>

        <div>
            @if ($showDateFilters)
                <div class='bg-gray-200 rounded shadow p-4 md:px-6 md:py-4'>
                    <div class='flex flex-col space-y-4 md:space-y-0 md:flex-row md:justify-around'>
                        <div class='md:w-1/3 divide-y divide-gray-500 space-y-3'>
                            <p class='text-gray-700 font-bold'>Filtrar pela data de início da reserva</p>
                            <div class='flex space-x-2 pt-2'>
                                <x-input.group inline for="filter-init-min" label="Data mínima">
                                    <x-input.date wire:model="filters.init-min" id="filter-init-min"
                                                  placeholder="DD/MM/AAAA" />
                                </x-input.group>
                                <x-input.group inline for="filter-init-max" label="Data máxima">
                                    <x-input.date wire:model="filters.init-max" id="filter-init-max"
                                                  placeholder="DD/MM/AAAA" />
                                </x-input.group>
                            </div>
                        </div>

                        <div class='md:w-1/3 divide-y divide-gray-500 space-y-3'>
                            <p class='text-gray-700 font-bold'>Filtrar pela data de término da reserva</p>
                            <div class='flex space-x-2 pt-2'>
                                <x-input.group inline for="filter-due-min" label="Data mínima">
                                    <x-input.date wire:model="filters.due-min" id="filter-due-min"
                                                  placeholder="DD/MM/AAAA" />
                                </x-input.group>
                                <x-input.group inline for="filter-due-max" label="Data máxima">
                                    <x-input.date wire:model="filters.due-max" id="filter-due-max"
                                                  placeholder="DD/MM/AAAA" />
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

        <div class="flex flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>Loteamento</x-table.heading>
                    <x-table.heading>Lote</x-table.heading>
                    <x-table.heading>Corretor</x-table.heading>
                    <x-table.heading>Cliente</x-table.heading>
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('init')"
                                     :direction="$sortField === 'init' ? $sortDirection : null">Reservado em
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('due')"
                                     :direction="$sortField === 'due' ? $sortDirection : null">Fim da reserva
                    </x-table.heading>
                    <x-table.heading></x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse($reservations as $reservation)
                        @php /** @var \App\Models\Reservation $reservation */ @endphp
                        <x-table.row wire:loading.class.delay='opacity-30'>
                            <x-table.cell>{{ $reservation->lot->allotment->title }}</x-table.cell>
                            <x-table.cell>{{ $reservation->lot->identification }}</x-table.cell>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ $reservation->user->profile_photo_url }}" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $reservation->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $reservation->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $reservation->reserveable->full_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    CPF: {{ $reservation->reserveable->cpf }}
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                @if ($reservation->isActive())
                                    <span class="font-medium text-xs text-green-800 bg-green-100 border border-green-800 rounded-full uppercase px-2.5 py-0.5 tracking-wider">
                                        Ativa
                                    </span>
                                @elseif ($reservation->cancelled_at)
                                    <span title='Cancelada em {{ $reservation->cancelled_at->format('d/m/Y') }}. Motivo: {{ $reservation->reason }}'
                                          class="font-medium text-xs text-red-800 bg-red-100 border border-red-800 rounded-full uppercase px-2.5 py-0.5 tracking-wider">
                                        Cancelada
                                    </span>
                                @else
                                    <span title='{{ $reservation->reason }}' class="font-medium text-xs text-red-800 bg-red-100 border border-red-800 rounded-full uppercase px-2.5 py-0.5 tracking-wider">
                                        Expirada
                                    </span>
                                @endif
                            </x-table.cell>
                            <x-table.cell>{{ $reservation->init->format('d/m/Y H:i:s') }}</x-table.cell>
                            <x-table.cell>{{ $reservation->due->format('d/m/Y H:i:s') }}</x-table.cell>
                            <x-table.cell>
                                @if($reservation->isActive())
                                <x-button-link format="icon" title="Cancelar reserva" href="{{ route('reservation.cancel', $reservation->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </x-button-link>
                                @endif
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
                                    <span class='text-lg'>Nenhuma reserva encontrada.</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>
