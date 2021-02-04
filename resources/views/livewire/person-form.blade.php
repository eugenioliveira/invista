@php
    /** @var \App\Models\Person $person */
    /** @var \App\Models\PersonDetail $detail */
@endphp

<x-card class="p-4 max-w-3xl mx-auto">

    @if($successMessage)
        <x-alert type="success" message="{{ $successMessage }}"/>
    @endif

    <form>
        <x-person-inputs :address="true"/>

        <x-input-row class="mt-6 mb-6 md:mt-0 items-center">
            <h2 class="text-lg uppercase tracking-widest">Cônjuge</h2>
            <div class="flex-1 h-0.5 bg-gray-200"></div>
        </x-input-row>

        <div class="md:mb-4">
            <div class="md:flex bg-orange-100 border shadow-lg rounded-md border-orange-400">
                <div class="bg-orange-400 text-white md:flex md:justify-center md:items-center md:w-16">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                @if($partner->id)
                    <div class="md:w-1/3 px-4 py-2 md:flex md:items-center md:border-r md:border-dashed md:border-orange-400">
                        <div>
                            <h2 class="text-lg text-orange-600">{{ $partner->full_name }}</h2>
                            <p class="text-sm">CPF: {{ $partner->cpf }}</p>
                        </div>
                    </div>
                    <div class="md:w-1/3 p-2 md:flex md:items-center md:border-r md:border-dashed md:border-orange-400">
                        <p class="text-sm">
                            @if($partner->detail)
                                <span class="text-green-500 font-medium">As informações do cônjuge estão completas.</span>
                            @else
                                <span class="text-red-500 font-medium">As informações do cônjuge estão incompletas!</span>
                                <br>
                                <span class="text-xs">Faltam informações como naturalidade, nacionalidade, renda mensal...</span>
                            @endif
                        </p>
                    </div>
                    <div class="p-2">
                        <x-button type="button" class="mb-2" wire:click="removePartner">Remover cônjuge</x-button>
                        <livewire:partner-modal button-text="Editar cônjuge" :person="$partner"/>
                    </div>
                @else
                    <div class="px-4 py-2 flex items-center border-r border-dashed border-orange-400">
                        <div>
                            <h2 class="text-lg text-orange-600">Nenhum cônjuge cadastrado.</h2>
                            <p class="text-sm">O cadastro de cônjuge é obrigatório se o estado civil é casado(a).</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 flex flex-col">
                        <div>
                            <label for="partner_cpf" class="text-orange-600 text-sm font-medium">Digite o CPF do cônjuge</label>
                            <div class="flex items-center space-x-2">
                                <input
                                        id="partner_cpf"
                                        name="partner_cpf"
                                        type="text"
                                        wire:model.lazy="state.partner_cpf"
                                        class="mt-1 px-2 py-1 border border-orange-400 rounded-md appearance-none focus:outline-none focus:ring focus:ring-orange-400"
                                >
                                <button
                                        type="button"
                                        class="bg-orange-400 text-white hover:bg-orange-600 transition duration-150 px-4 py-2 rounded-md"
                                        wire:click="addPartner"
                                >
                                    OK
                                </button>
                            </div>
                            @error('state.partner_cpf')
                            <p class="mt-1 text-sm font-bold text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center space-x-2 my-2">
                            <div class="border-b border-orange-400 flex-1"></div>
                            <div>ou</div>
                            <div class="border-b border-orange-400 flex-1"></div>
                        </div>
                        <livewire:partner-modal button-text="Cadastrar cônjuge"/>
                    </div>
                @endif
            </div>
        </div>

        <x-input-row class="mt-6 flex flex-col space-y-2 md:space-y-0 md:flex-row">
            <x-button type="button" wire:click="savePerson">Salvar e Voltar</x-button>
            <x-button type="button" wire:click="savePerson(false)">Salvar e Continuar</x-button>
            <x-button-link type="danger" href="{{ url()->previous() }}">Cancelar</x-button-link>
        </x-input-row>
    </form>

</x-card>