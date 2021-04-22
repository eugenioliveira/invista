@php
    /** @var \App\Models\Allotment $allotment */
    /** @var \App\Models\Allotment $currentAllotment */
@endphp
<div>
    {{-- Mensagem de sucesso --}}
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
    @endif

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
                        <x-button-link class="w-full justify-center" href="{{ route('lots.index', $allotment->id) }}">
                            Ver lotes
                        </x-button-link>
                    @else
                        <x-button class="w-full justify-center" wire:click="showOptions({{ $allotment->id }})">
                            Opções
                        </x-button>
                    @endif
                </div>
            </x-card>
        @endforeach
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="ml-2">Ver lotes</span>
                        </a>
                    </li>
                @endcan

                {{-- Gerenciar corretores --}}
                @can('allow_brokers')
                    <li>
                        <a href="/" class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="ml-2">Corretores permitidos</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </x-slot>
    </x-slide-over>
</div>