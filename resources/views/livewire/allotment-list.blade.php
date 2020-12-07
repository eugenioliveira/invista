@php
    /** @var \App\Models\Allotment $allotment */
@endphp
<div x-data="{ showPanel: false, allotmentId: '', allotmentTitle: '' }">
    @if(session('successMessage'))
        <x-alert type="success" message="{{ session('successMessage') }}"/>
@endif
<!-- Search and Pagination -->
    <x-search-pagination search-placeholder="Ex.: Loteamento São Bento" :links="$allotments->links('vendor.pagination.tailwind')"/>

    <!-- Allotment Grid -->
    <div class="p-4 md:p-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($allotments as $allotment)
            <x-card class="overflow-hidden" wire:key="{{ $allotment->id }}">
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
                    <x-button
                        class="w-full justify-center"
                        x-on:click="
                            showPanel = true;
                            allotmentTitle = '{{ $allotment->title }}';
                            allotmentId = '{{ $allotment->id }}'
                            "
                    >
                        Opções
                    </x-button>
                </div>
            </x-card>
        @endforeach
    </div>
    <!-- End allotment Grid -->
    <!--
      Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
      Read the documentation to get started: https://tailwindui.com/documentation
    -->
    <div x-show="showPanel" class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div
                x-show="showPanel"
                x-transition:enter="ease-in-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-black bg-opacity-75"
            ></div>
            <section class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                <div
                    x-show="showPanel"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="relative w-screen max-w-md"
                >
                    <div
                        x-show="showPanel"
                        x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute top-0 left-0 -ml-8 pt-4 pr-2 flex sm:-ml-10 sm:pr-4"
                    >
                        <button x-on:click="showPanel = false" aria-label="Close panel"
                                class="text-gray-300 hover:text-white transition ease-in-out duration-150">
                            <!-- Heroicon name: x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl">
                        <header class="px-4 sm:px-6">
                            <h2 x-text="allotmentTitle" class="text-lg leading-7 font-medium text-gray-900"></h2>
                        </header>
                        <hr class="my-2">
                        <div class="relative flex-1 px-4 sm:px-6">
                            <!-- Replace with your content -->
                            <ul>
                                <!-- Edit -->
                                @can('edit_allotment')
                                    <li>
                                        <a :href="'/allotments/edit/' + allotmentId"
                                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span class="ml-2">Editar loteamento</span>
                                        </a>
                                    </li>
                                @endcan
                                <!-- Lots -->
                                @can('view_lots')
                                    <li>
                                        <a :href="'/allotments/' + allotmentId + '/lots'"
                                           class="flex items-center px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                            </svg>
                                            <span class="ml-2">Ver lotes</span>
                                        </a>
                                    </li>
                                @endcan
                                <!-- Brokers -->
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
                            <!-- /End replace -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

