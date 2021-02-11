<x-card class="p-4 my-2">
    <label for="shareholder_search" class="text-sm font-medium">Busca de pessoas</label>
    <div class="relative" x-data="{ isVisible: true }" x-on:click.away="isVisible = false">
        <input
                type="text"
                name="search"
                id="search"
                placeholder="Digite o nome ou CPF do sócio para buscar"
                autocomplete="off"
                class="w-full border border-orange-500 pl-12 pr-4 py-2 rounded-lg"
                wire:model.debounce.300ms="search"
                x-on:focus="isVisible = true"
                x-on:keydown.escape.window="isVisible = false"
                x-on:keydown="isVisible = true"
        />
        <div class="absolute inset-y-0 left-0 ml-4 flex items-center text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <div wire:loading class="absolute inset-y-0 right-0 mr-4 flex items-center text-orange-500">
            <svg class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        @if (strlen($search) >= 2)
            <div
                    x-show.transition.opacity.duration.500ms="isVisible"
                    class="absolute z-10 w-full px-4 py-2 mt-2 shadow rounded-lg bg-orange-50 border border-orange-500 divide-y divide-orange-500"
            >
                @forelse($searchResults as $key => $person)
                    <div class="flex items-center">
                        <div class="py-2">
                            <a href="#" class="text-sm font-medium text-gray-900 hover:underline">
                                {{ $person->full_name }}
                            </a>
                            <div class="text-sm">
                                CPF: {{ $person->cpf }}
                            </div>
                        </div>
                        <x-button type="button" wire:click="selectPerson({{ $key }})" class="ml-4">Selecionar</x-button>
                    </div>
                @empty
                    <div>Nenhum resultado para "{{ $search }}" ou a pessoa correspondente já está adicionada.</div>
                @endforelse
            </div>
        @endif
    </div>
</x-card>