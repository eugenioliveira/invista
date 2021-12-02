<div class="p-2 md:p-0 grid grid-cols-1 md:grid-cols-4 gap-4">
    {{-- Sale card --}}
    <x-dashboard-card>
        <x-slot name="icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </x-slot>

        <x-slot name="title">Total de vendas</x-slot>
        <x-slot name="stat">R$ 0,00</x-slot>

        <x-slot name="action">
            <a href="/" class="text-sm font-medium text-yellow-600 hover:underline">Ver todas as vendas</a>
        </x-slot>
    </x-dashboard-card>

    {{-- Users card --}}
    <x-dashboard-card>
        <x-slot name="icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </x-slot>

        <x-slot name="title">Usuários</x-slot>
        <x-slot name="stat">{{ $usersCount }}</x-slot>

        <x-slot name="action">
            <a href="{{ route('users.index') }}" class="text-sm font-medium text-yellow-600 hover:underline">Gerenciar usuários</a>
        </x-slot>
    </x-dashboard-card>

    {{-- Brokers card --}}
    <x-dashboard-card>
        <x-slot name="icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </x-slot>

        <x-slot name="title">Corretores</x-slot>
        <x-slot name="stat">{{ $brokersCount }}</x-slot>

        <x-slot name="action">
            <a href="{{ route('users.index', ['brokers' => true]) }}" class="text-sm font-medium text-yellow-600 hover:underline">Gerenciar corretores</a>
        </x-slot>
    </x-dashboard-card>

    {{-- Allotments card --}}
    <x-dashboard-card>
        <x-slot name="icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
            </svg>
        </x-slot>

        <x-slot name="title">Loteamentos</x-slot>
        <x-slot name="stat">{{ $allotmentCount }}</x-slot>

        <x-slot name="action">
            <a href="{{ route('allotments.index') }}" class="text-sm font-medium text-yellow-600 hover:underline">Gerenciar loteamentos</a>
        </x-slot>
    </x-dashboard-card>
</div>
