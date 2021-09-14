@php
    /** @var \Illuminate\Database\Eloquent\Collection $lots */
    /** @var \App\Models\Lot $lot */
    /** @var \Illuminate\Support\Collection $reserved */
@endphp
<div>
    {{-- Success message --}}
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
    @endif

    @if ($lots->isNotEmpty())

        {{-- Search and Pagination --}}
        <x-search-pagination search-placeholder="Ex.: A25" :links="$lots->links('vendor.pagination.tailwind')"/>

        {{-- Lots grid --}}
        <div class="p-4 md:p-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($lots as $lot)
                <x-card class="overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <h2 class="font-medium text-lg text-primary">{{ $lot->identification }}</h2>
                            @if($lot->activeReservation)
                                <div>
                                    <x-lot-status-badge
                                            :status="\App\Enums\LotStatusType::RESERVED()"></x-lot-status-badge>
                                    <span class="text-xs">até {{ $lot->activeReservation->due->format('d/m/Y H:i') }}</span>
                                </div>
                            @else
                                <x-lot-status-badge :status="$lot->latestStatus->type"></x-lot-status-badge>
                            @endif
                        </div>
                        <hr class="my-2">
                        <div class="text-sm mb-2">
                            <p>
                                <span class="font-medium">Área: </span>
                                <span>{{ $lot->area }} m<sup>2</sup></span>
                            </p>
                            <p>
                                <span class="font-medium">Preço: </span>
                                <span>{{ $lot->formatted_price }}</span>
                            </p>
                        </div>
                        {{-- Este botão só deve ser exibido se o lote estiver disponível --}}
                        @if(!$lot->activeReservation && $lot->isAvailable())
                            <x-button-link class="w-full justify-center" href="{{ route('lot.reserve', $lot->id) }}">
                                Reservar
                            </x-button-link>
                        @endif

                        {{-- Este botão só deve ser exibido se o lote estiver reservado e a reserva pertencer ao usuário atual --}}
                        @if($lot->activeReservation)
                            @if($lot->activeReservation->user_id == \Auth::user()->id)
                                <div class="flex space-x-2 items-center"
                                     x-data="{ url: '{{ route('reservation.cancel', $lot->activeReservation->id) }}' }">
                                    <x-button-link type="success" class="w-full text-center" href="">
                                        Fazer proposta
                                    </x-button-link>
                                    <x-button-link
                                            @click.prevent="confirm('Você tem certeza?') ? location.href=url : false"
                                            type="danger"
                                            class="w-full text-center"
                                            href="#">
                                        Cancelar reserva
                                    </x-button-link>

                                </div>
                            @endif
                        @endif

                    </div>
                </x-card>
            @endforeach
        </div>


    @else
        <x-alert type="warning" message="Nenhum lote cadastrado."
                 :autoclose="false"></x-alert>
    @endif

</div>
