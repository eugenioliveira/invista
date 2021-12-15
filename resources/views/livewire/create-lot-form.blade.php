<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form wire:submit.prevent="createNewLot">
        @include('livewire.partials.lot-inputs')
        <x-input-row class="mb-6">
            <h2 class="text-lg uppercase tracking-widest">Status inicial</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>
        <x-input-row class="mb-6">
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::AVAILABLE }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::AVAILABLE()->description }}</span>
            </label>
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::BLOCKED }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::BLOCKED()->description }}</span>
            </label>
            <label class="flex items-center space-x-3">
                <input
                    type="radio"
                    name="type"
                    wire:model.lazy="statusType"
                    value="{{ \App\Enums\LotStatusType::SOLD }}"
                    class="appearance-none h-4 w-4 border border-orange-500 rounded-full checked:bg-primary checked:border-transparent focus:outline-none"
                >
                <span>{{ \App\Enums\LotStatusType::SOLD()->description }}</span>
            </label>
            <div>
                @error('statusType')
                <div class="mt-1 flex items-center">
                    <span class="font-medium text-red-500 text-xs">{{ $message }}</span>
                </div>
                @enderror
            </div>
        </x-input-row>
        <x-input-row>
            <x-button>Salvar e Voltar</x-button>
            <x-button type="button" wire:click="createNewLot(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('lots.index', $allotment->id) }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>
