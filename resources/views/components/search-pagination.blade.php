<x-card class="mb-4 p-4 md:flex md:justify-between md:items-end">
    <div class="md:w-2/6 my-4 md:my-0">
        <div>
            <label for="searchTerm" class="block text-sm font-medium text-gray-700">Digite aqui o termo de busca</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input
                    wire:model.debounce.500ms="searchTerm"
                    id="searchTerm"
                    class="block w-full py-1.5 rounded-lg border pl-4 pr-12 focus:border-orange-300 focus:ring focus:ring-yellow-600  focus:outline-none"
                    placeholder="{{ $searchPlaceholder }}"
                    autocomplete="off"
                >
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <x-button type="button" wire:click="$set('searchTerm', '')">Limpar</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="md:w-4/6">{!! $links !!}</div>
</x-card>
