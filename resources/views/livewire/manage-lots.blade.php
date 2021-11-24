@php
    /** @var \Illuminate\Database\Eloquent\Collection $lots */
    /** @var \App\Models\Lot $lot */
@endphp
<div>
    {{-- Success message --}}
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}" />
    @endif

    @if ($lots->isNotEmpty())

        {{-- Search and Pagination --}}
        <x-search-pagination search-placeholder="Ex.: A25" :links="$lots->links('vendor.pagination.tailwind')" />

        {{-- Lots table --}}
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
                    <tr>
                        {{-- ID --}}
                        <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
                            {{ $lot->id }}
                        </td>
                        {{-- Ident --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $lot->identification }}
                        </td>
                        {{-- Price --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $lot->formatted_price }}
                        </td>
                        {{-- Area --}}
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="inline cursor-help relative" x-data="{ isOpen: false }">
                                <span
                                        class="text-primary hover:underline"
                                        x-on:click="isOpen = true"
                                        x-on:click.away="isOpen = false"
                                >
                                    {{ $lot->area }} m<sup>2</sup>
                                </span>
                                <div x-show="isOpen" style="display: none"
                                     class="absolute z-30 bg-gray-200 border border-gray-300 shadow rounded-md px-6 py-4 w-80">
                                    <div class="divide-y divide-gray-400 divide-dashed">
                                        @foreach($lot->getSides() as $side)
                                            <div class="text-xs py-2">{{ $side }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- Status --}}
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                            <div>
                                @if($lot->activeProposal)
                                    <div class="flex flex-col items-start">
                                        <x-lot-status-badge
                                                title="Proposta efetuada por {{ $lot->activeProposal->user->name }} - {{ $lot->activeProposal->latestStatus->type->description }}"
                                                :status="\App\Enums\LotStatusType::PROPOSED()"></x-lot-status-badge>
                                    </div>
                                @elseif($lot->activeReservation)
                                    <div class="flex flex-col items-start">
                                        <x-lot-status-badge
                                                title="Reservado por {{ $lot->activeReservation->user->name }} até {{ $lot->activeReservation->due->format('d/m/Y H:i') }}"
                                                :status="\App\Enums\LotStatusType::RESERVED()"></x-lot-status-badge>
                                    </div>
                                @else
                                    <x-lot-status-badge :status="$lot->latestStatus->type"></x-lot-status-badge>
                                @endif
                            </div>
                        </td>
                        {{-- Actions --}}
                        <td class="px-6 py-4 flex space-x-1">
                            {{-- Edit action --}}
                            <x-button-link href="{{ route('lot.edit', $lot->id) }}" format="icon" title="Editar">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </x-button-link>
                            {{-- Show reservations action --}}
                            @if ($lot->reservations->isNotEmpty())
                                <div>
                                    <x-button-link href="{{ route('reservations.index', ['lot' => $lot->id]) }}" format="icon"
                                                   title="Ver reservas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </x-button-link>
                                </div>
                            @endif
                            {{-- Show proposals action --}}
                            @if ($lot->proposals->isNotEmpty())
                                <div>
                                    <x-button-link href="{{ route('proposals.index', ['lot' => $lot->id]) }}" format="icon"
                                                   title="Ver propostas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                    </x-button-link>
                                </div>
                            @endif
                            {{-- Change static status action --}}
                            <x-button-link format="icon" title="Mudar status"
                                           wire:click="showStatusChangeForm({{ $lot->id }})">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"></path>
                                </svg>
                            </x-button-link>
                        </td>
                    </tr>
                @endforeach

                {{-- More rows... --}}
                </tbody>
            </table>
        </x-card>
    @else
        <x-alert type="warning" message="Nenhum lote cadastrado. Crie um novo ou realize uma importação."
                 :autoclose="false"></x-alert>
    @endif

    <x-modal wire:model.defer="showChangeStatusModal" wire:ignore.self>
        <x-slot name="title">Mudar status do lote {{ $currentLot->identification }}</x-slot>

        <x-slot name="body">
            <div class="my-4">
                <x-select
                        label="Novo status"
                        name="type"
                        class="mt-1 w-full"
                        wire:model.lazy="state.type"
                        error="{{ $errors->first('type') }}"
                >
                    <option>Selecione...</option>
                    @foreach(\App\Enums\LotStatusType::staticStatuses() as $statusType)
                        <option value="{{ $statusType->value }}">{{ $statusType->description }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="my-4">
                <x-textarea
                        label="Justificativa"
                        name="reason"
                        class="mt-1 w-full"
                        wire:model.defer="state.reason"
                        error="{{ $errors->first('reason') }}"
                >
                </x-textarea>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button-link href="#" type="danger" wire:click.prevent="toggleModal">Cancelar</x-button-link>
            <x-button type="button" wire:click.prevent="changeStatus" class="ml-2">Mudar status</x-button>
        </x-slot>
    </x-modal>

</div>
