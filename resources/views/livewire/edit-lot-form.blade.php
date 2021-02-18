<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form wire:submit.prevent="updateLot">
        @include('livewire.partials.lot-inputs')
        <x-input-row>
            <x-button>Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updateLot(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ route('lots.index', $lot->allotment_id) }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>
