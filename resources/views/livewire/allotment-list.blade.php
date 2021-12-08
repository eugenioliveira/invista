@php
    /** @var \App\Models\Allotment $allotment */
    /** @var \App\Models\Allotment $currentAllotment */
@endphp
<div>
    {{-- Mensagem de sucesso --}}
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}" />
    @endif

    <div>
        @if($allotments->isNotEmpty())
        {{-- Busca e paginação --}}
        <x-search-pagination
                search-placeholder="Ex.: Loteamento São Bento"
                :links="$allotments->links('vendor.pagination.tailwind')"
        ></x-search-pagination>

        {{-- Grid de Loteamentos --}}
        <div class="p-4 md:p-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($allotments as $allotment)
                <x-card class="overflow-hidden">
                    <img src="{{ $allotment->cover_url }}" class="w-full h-32 object-cover">
                    <div class="p-4">
                        <h2 class="font-medium text-lg text-primary">{{ $allotment->title }}</h2>
                        <hr class="my-2">
                        <div class="text-sm mb-2">
                            <p>
                                <span class="font-medium">Lotes: </span>
                                <span class="lotCount">{{ $allotment->lots_count }}</span>
                            </p>
                            <p>
                                <span class="font-medium">Área: </span>
                                <span>{{ $allotment->area }} m<sup>2</sup></span>
                            </p>
                            <p>
                                <span class="font-medium">Cidade: </span>
                                <span>{{ $allotment->city->full_name }}</span>
                            </p>
                        </div>
                        {{-- Este botão só deve ser exibido se o usuário for admin --}}
                        @if(Auth::user()->isBroker())
                            <div class='flex space-x-2'>
                                <x-button-link class="w-full justify-center"
                                               href="{{ route('lots.index', $allotment->id) }}">
                                    Ver lotes
                                </x-button-link>
                                @if($allotment->map)
                                    <x-button-link class="w-full justify-center"
                                                   target="_blank"
                                                   href="{{ route('map.show', [$allotment->map->id, 'edit' => false]) }}">
                                        Ver mapa
                                    </x-button-link>
                                @endif
                            </div>
                        @else
                            <x-button class="w-full justify-center" wire:click="showOptions({{ $allotment->id }})">
                                Opções
                            </x-button>
                        @endif
                    </div>
                </x-card>
            @endforeach
        </div>
        @else
            <x-alert type='warning' message='' :autoclose='false'>
                Não há loteamentos para exibir. Verifique com um administrador se você possui permissões para
                ver algum dos loteamentos.
            </x-alert>
        @endif
    </div>

    {{-- Menu de opções --}}
    <x-slide-over wire:model.defer="showOptionsPanel">
        <x-slot name="title">{{ $currentAllotment->title ?? '' }}</x-slot>
        <x-slot name="body">
            <ul>
                {{-- Editar --}}
                @can('edit_allotment')
                    <li>
                        <a href="{{ $currentAllotment->id ? route('allotment.edit', $currentAllotment->id) : '' }}"
                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span class="ml-2">Editar loteamento</span>
                        </a>
                    </li>
                @endcan

                {{-- Lotes --}}
                @can('view_lots')
                    <li>
                        <a href="{{ $currentAllotment->id ? route('lots.index', $currentAllotment->id) : '' }}"
                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="ml-2">Ver lotes</span>
                        </a>
                    </li>
                @endcan

                {{-- Gerenciar corretores
                @can('allow_brokers')
                    <li>
                        <a href="/" class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="ml-2">Corretores permitidos</span>
                        </a>
                    </li>
                @endcan--}}

                {{-- Planos de pagamento --}}
                @can('edit_allotment')
                    <li>
                        <a href="{{ $currentAllotment->id ? route('allotment.payment-plans', $currentAllotment->id) : '' }}"
                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-2">Planos de pagamento</span>
                        </a>
                    </li>
                @endcan

                {{-- Mapa --}}
                @can('edit_allotment')
                    <li>
                        <a href="{{ $currentAllotment->id ? route('map.edit', $currentAllotment->id) : '' }}"
                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            <span class="ml-2">Criar/Editar mapa</span>
                        </a>
                    </li>
                @endcan

                {{-- Marcadores do Mapa --}}
                @can('edit_allotment')
                    @if($currentAllotment->map)
                        <li>
                            <a href="{{ $currentAllotment->id ? route('map.show', [$currentAllotment->map->id, 'edit' => true]) : '' }}"
                               class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="ml-2">Posicionar marcadores do mapa</span>
                            </a>
                        </li>
                    @endif
                @endcan
            </ul>
        </x-slot>
    </x-slide-over>
</div>