<div x-data="{ on: @entangle('showModal') }">

    <!-- Trigger -->
    <x-button-link href="#" x-on:click.prevent="on = true" format="icon" title="Mudar status">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"></path>
        </svg>
    </x-button-link>

    <!-- Modal -->
    <x-modal-container>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h2 class="font-bold text-lg">Mudar o status do lote {{ $lot->identification }}</h2>
            <hr class="my-3">
            <form>
                <x-input-row class="mb-4">
                    <x-select
                        label="Novo status"
                        name="status"
                        class="mt-1 w-full"
                        wire:model.lazy="status"
                        error="{{ $errors->first('status') }}"
                    >
                        <option>Selecione...</option>
                        @foreach(\App\Enums\LotStatusType::staticStatuses() as $status)
                            <option value="{{ $status->value }}">{{ $status->description }}</option>
                        @endforeach
                    </x-select>
                </x-input-row>
                <x-input-row>
                    <div class="w-full">
                        <x-textarea
                            label="Justificativa"
                            name="reason"
                            class="mt-1 w-full"
                            wire:model.lazy="reason"
                            error="{{ $errors->first('reason') }}"
                        ></x-textarea>
                    </div>
                </x-input-row>
            </form>
        </div>
        <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button type="button"
                        wire:click="changeStatus"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring foxus:ring-red  transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Mudar status
                </button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button x-on:click="on = false" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-600 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cancelar
                </button>
            </span>
        </div>
    </x-modal-container>

</div>
