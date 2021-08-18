@php
    /** @var \App\Models\Person $person */
@endphp
<div class="p-4 max-w-3xl mx-auto">
    {{-- CPF da pessoa --}}
    <livewire:search-person-dropdown/>

    <x-card class="p-4 max-w-3xl mx-auto">

        @if($successMessage)
            <x-alert type="success" message="{{ $successMessage }}"/>
        @endif

        @if($errorMessage)
            <x-alert type="danger" message="{{ $errorMessage }}"/>
        @endif

        <form>

            @include('livewire.partials.person-inputs')

            <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
                <x-button type="button" wire:click="reserve">Reservar</x-button>
                <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
            </x-input-row>
        </form>

    </x-card>
</div>