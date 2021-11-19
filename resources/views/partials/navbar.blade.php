<div>
    <div class="hidden md:block">
        <div class="bg-primary text-white">

            <div class="container mx-auto flex items-center justify-between py-4">
                {{-- Left section of navbar --}}
                <div class="flex items-center">
                    {{-- logo --}}
                    <x-full-logo></x-full-logo>

                    {{-- Nav Links --}}
                    <nav class="ml-4 flex items-center space-x-1">
                        <x-nav-link route="home">Home</x-nav-link>

                        @can('view_allotments')
                            <x-nav-dropdown title="Loteamentos" route="allotments">
                                <x-dropdown-link href="{{ route('allotments.index') }}">Listar</x-dropdown-link>
                                @can('create_allotment')
                                    <x-dropdown-link href="{{ route('allotment.create') }}">Novo</x-dropdown-link>
                                @endcan
                            </x-nav-dropdown>
                        @endcan
                        @can('view_users')
                            <x-nav-link route="users.index">Usuários</x-nav-link>
                        @endcan
                        @can('view_people')
                            <x-nav-dropdown title="Pessoas físicas" route="person">
                                <x-dropdown-link href="{{ route('people.index') }}">Listar</x-dropdown-link>
                                @can('create_person')
                                    <x-dropdown-link href="{{ route('person.create') }}">Novo</x-dropdown-link>
                                @endcan
                            </x-nav-dropdown>
                        @endcan
                        @can('view_companies')
                        <!--<x-nav-dropdown title="Pessoas jurídicas" route="company">
                                <x-dropdown-link href="{{ route('companies.index') }}">Listar</x-dropdown-link>
                                @can('create_company')
                            <x-dropdown-link href="{{ route('companies.create') }}">Novo</x-dropdown-link>
                                @endcan
                                </x-nav-dropdown>-->
                        @endcan
                        @can('manage_payment_plans')
                            <x-nav-dropdown title="Planos" route="payment-plans">
                                <x-dropdown-link href="{{ route('payment-plans.index') }}">Listar</x-dropdown-link>
                            </x-nav-dropdown>
                        @endcan
                        @can('view_reservations')
                            <x-nav-link route="reservations.index">Reservas</x-nav-link>
                        @endcan
                        <x-nav-link route="clients.index">Propostas</x-nav-link>
                        <x-nav-link route="sales.index">Vendas</x-nav-link>
                    </nav>
                </div>

                {{-- User dropdown --}}
                <x-user-dropdown></x-user-dropdown>
            </div>
        </div>
        <div class="bg-gray-500 h-1"></div>
    </div>

    <div class="md:hidden" x-data="{ open: false }">
        <div class="bg-primary text-white p-4">
            <div class="flex items-center justify-between">
                <div>
                    <x-full-logo></x-full-logo>
                </div>

                <x-user-dropdown></x-user-dropdown>

                <div>
                    <button class="focus:outline-none" x-on:click="open = !open">
                        <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <nav
                class="flex flex-col bg-primary text-white p-4"
                x-show="open"
                x-transition:enter="transition transform origin-top duration-300"
                x-transition:enter-start="scale-y-0"
                x-transition:enter-end="scale-y-100"
                x-transition:leave="transition transform origin-top duration-200"
                x-transition:leave-start="scale-y-100"
                x-transition:leave-end="scale-y-0"
        >
            <x-mobile-nav-link route="home">Home</x-mobile-nav-link>

            @can('view_allotments')
                <x-mobile-nav-dropdown title="Loteamentos" route="allotments">
                    <x-mobile-nav-dropdown-link href="{{ route('allotments.index') }}">Listar
                    </x-mobile-nav-dropdown-link>
                    @can('create_allotment')
                        <x-mobile-nav-dropdown-link href="{{ route('allotment.create') }}">Novo
                        </x-mobile-nav-dropdown-link>
                    @endcan
                </x-mobile-nav-dropdown>
            @endcan
            @can('view_users')
                <x-mobile-nav-link route="users.index">Usuários</x-mobile-nav-link>
            @endcan
            @can('view_people')
                <x-mobile-nav-dropdown title="Pessoas físicas" route="person">
                    <x-mobile-nav-dropdown-link href="{{ route('people.index') }}">Listar</x-mobile-nav-dropdown-link>
                    @can('create_person')
                        <x-mobile-nav-dropdown-link href="{{ route('person.create') }}">Novo
                        </x-mobile-nav-dropdown-link>
                    @endcan
                </x-mobile-nav-dropdown>
            @endcan
            @can('view_companies')
            <!--<x-mobile-nav-dropdown title="Pessoas jurídicas" route="company">
                    <x-mobile-nav-dropdown-link href="{{ route('companies.index') }}">Listar</x-mobile-nav-dropdown-link>
                    @can('create_company')
                <x-mobile-nav-dropdown-link href="{{ route('companies.create') }}">Novo</x-mobile-nav-dropdown-link>
                    @endcan
                    </x-mobile-nav-dropdown>-->
            @endcan
            @can('manage_payment_plans')
                <x-mobile-nav-dropdown title="Planos" route="payment-plans">
                    <x-mobile-nav-dropdown-link href="{{ route('payment-plans.index') }}">Listar
                    </x-mobile-nav-dropdown-link>
                </x-mobile-nav-dropdown>
            @endcan
            <x-mobile-nav-link route="clients.index">Reservas</x-mobile-nav-link>
            <x-mobile-nav-link route="clients.index">Propostas</x-mobile-nav-link>
            <x-mobile-nav-link route="sales.index">Vendas</x-mobile-nav-link>
        </nav>
    </div>
</div>