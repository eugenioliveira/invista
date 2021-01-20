@php
    /** @var \Illuminate\Database\Eloquent\Collection $lots */
    /** @var \App\Models\Lot $lot */
@endphp
<div>
    <!-- Success message -->
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
    @endif

    @if ($lots->isNotEmpty())

    <!-- Search and Pagination -->
        <x-search-pagination search-placeholder="Ex.: A25" :links="$lots->links('vendor.pagination.tailwind')"/>

        <!-- Lots table -->
        <x-card class="my-4 p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        #
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Identificação
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Preço
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Área total
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($lots as $lot)
                    <tr wire:key="{{ $lot->id }}">
                        <!-- ID -->
                        <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
                            {{ $lot->id }}
                        </td>
                        <!-- Ident -->
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $lot->identification }}
                        </td>
                        <!-- Price -->
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $lot->formatted_price }}
                        </td>
                        <!-- Area -->
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="inline cursor-help relative" x-data="{ isOpen: false }">
                                <span
                                    class="text-primary hover:underline"
                                    x-on:click="isOpen = true"
                                    x-on:click.away="isOpen = false"
                                >
                                    {{ $lot->area }} m<sup>2</sup>
                                </span>
                                <div x-show="isOpen" class="absolute z-30 bg-gray-200 border border-gray-300 shadow rounded-md px-6 py-4 w-80">
                                    <div class="divide-y divide-gray-400 divide-dashed">
                                        @foreach($lot->getSides() as $side)
                                            <div class="text-xs py-2">{{ $side }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                            <x-lot-status-badge :status="$lot->getStatus()"></x-lot-status-badge>
                        </td>
                        <!-- Actions -->
                        <td class="px-6 py-4 flex space-x-1">
                            <!-- Edit action -->
                            <x-button-link href="{{ route('lot.edit', $lot->id) }}" format="icon" title="Editar">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </x-button-link>
                            <!-- Show reservations action -->
                            <!-- Show proposals action -->
                            <!-- Change static status action -->
                            <livewire:change-lot-status-modal :lot="$lot" :key="'change-lot-status-modal-'.$lot->id"/>
                        </td>
                    </tr>
                @endforeach

                <!-- More rows... -->
                </tbody>
            </table>
        </x-card>
    @else
        <x-alert type="warning" message="Nenhum lote cadastrado. Crie um novo ou realize uma importação." :autoclose="false"></x-alert>
    @endif

</div>
