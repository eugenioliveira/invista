<div class="bg-primary text-white hidden md:block">

    <div class="container mx-auto flex items-center justify-between py-4">
        <!-- Left section of navbar -->
        <div class="flex items-center">
            <!-- logo -->
            <x-full-logo/>

            <!-- Nav Links -->
            <nav class="ml-8 flex space-x-1">
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
                        @can('create_people')
                            <x-dropdown-link href="{{ route('person.create') }}">Novo</x-dropdown-link>
                        @endcan
                    </x-nav-dropdown>
                @endcan
                <x-nav-link route="clients.index">Reservas</x-nav-link>
                <x-nav-link route="clients.index">Propostas</x-nav-link>
                <x-nav-link route="sales.index">Vendas</x-nav-link>
            </nav>
        </div>

        <!-- User dropdown -->
        <x-user-dropdown/>
    </div>
</div>
<div class="bg-gray-500 h-1"></div>
