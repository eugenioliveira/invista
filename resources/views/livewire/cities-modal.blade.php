<div>
    <x-button type="button" wire:click="$set('showModal', true)">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
    </x-button>

    <x-modal wire:model.defer="showModal">
        <x-slot name="title">Criar nova cidade</x-slot>

        <x-slot name="body">
            <x-input-row class="space-y-3 md:space-y-0 md:mb-4">
                <!-- Nome -->
                <div class="md:w-1/2">
                    <x-input
                            label="Nome"
                            name="name"
                            class="mt-1 w-full"
                            wire:model.defer="state.name"
                            error="{{ $errors->first('name') }}"
                    />
                </div>
                <!-- Estado -->
                <div class="md:w-1/2">
                    <x-input
                            label="Estado"
                            name="state"
                            class="mt-1 w-full"
                            wire:model.defer="state.state"
                            error="{{ $errors->first('state') }}"
                    />
                </div>
            </x-input-row>
        </x-slot>

        <x-slot name="footer">
            <x-button-link href="#" type="danger" wire:click.prevent="$set('showModal', false)">Cancelar</x-button-link>
            <x-button type="button" wire:click="createCity" class="ml-2">Criar</x-button>
        </x-slot>
    </x-modal>
</div>