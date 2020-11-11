<div x-data="{ on: @entangle('showModal') }">

    <x-button-link href="#" x-on:click.prevent="on = true" format="square">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd"></path>
        </svg>
    </x-button-link>

    <x-modal-container>
        <form wire:submit.prevent="addCity">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <x-input-row>
                    <!-- Cidade -->
                    <div class="w-1/2">
                        <x-input
                            label="Cidade"
                            name="name"
                            class="mt-1 w-full"
                            wire:model.defer="name"
                            error="{{ $errors->first('name') }}"
                        />
                    </div>
                    <!-- Estado -->
                    <div class="w-1/2">
                        <x-input
                            label="Estado"
                            name="state"
                            class="mt-1 w-full"
                            wire:model.defer="state"
                            error="{{ $errors->first('state') }}"
                        />
                    </div>
                </x-input-row>
            </div>
            <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button type="button" wire:click="addCity"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Salvar
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button x-on:click="on = false" wire:click="resetForm" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancelar
                    </button>
                </span>
            </div>
        </form>
    </x-modal-container>
</div>
