<div class="bg-primary text-white">

    <div class="container mx-auto flex items-center justify-between py-4">
        <!-- Left section of navbar -->
        <div class="flex items-center">
            <!-- logo -->
            <x-full-logo />

            <!-- Nav Links -->
            <nav class="ml-8 flex space-x-1">
                <x-nav-link route="home">Home</x-nav-link>

                <x-nav-dropdown title="Loteamentos" route="allotments">
                    <x-dropdown-link href="/allotments">Gerenciar</x-dropdown-link>
                    <x-dropdown-link href="/">Novo</x-dropdown-link>
                </x-nav-dropdown>

                <x-nav-link route="brokers.index">Corretores</x-nav-link>
                <x-nav-link route="clients.index">Clientes</x-nav-link>
                <x-nav-link route="sales.index">Vendas</x-nav-link>
            </nav>
        </div>

        <!-- User dropdown -->
        <x-user-dropdown />
    </div>
</div>
<div class="bg-gray-500 h-1"></div>
