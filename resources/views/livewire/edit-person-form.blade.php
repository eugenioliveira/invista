<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>

        @include('livewire.partials.person-inputs')

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="updatePerson">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="updatePerson(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>