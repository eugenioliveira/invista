<div>
    <div class="rounded-md shadow overflow-hidden max-w-3xl mx-auto">
        <!-- Header -->
        <div class="bg-primary border-b-2 border-gray-500 p-4">
            <h1 class="text-white font-bold">{{ $steps[$currentStep]['heading'] }}</h1>
            <h4 class="text-white text-sm opacity-90">{{ $steps[$currentStep]['subheading'] }}</h4>
        </div>

        <!-- Body -->
        <div class="bg-white">
            <div>
                @if($currentStep == 'proponent-step')
                    <livewire:proposal.proponent-step :lot="$lot" :proposal="$proposal" />
                @endif

                @if($currentStep == 'financial-step')
                    <livewire:proposal.financial-step :lot="$lot" :proposal="$proposal" />
                @endif

                @if($currentStep == 'document-step')
                    <livewire:proposal.document-step :lot="$lot" :proposal="$proposal"/>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="p-4 bg-gray-100 border-t-2 border-gray-500 flex justify-around">

            <div>
                @if ($steps[$currentStep]['nextStep'])
                <x-button type="button" wire:click="nextStep">
                    Avançar
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                              clip-rule="evenodd" />
                    </svg>
                </x-button>
                @else
                    <x-button type="button" wire:click="submitProposal">
                        Enviar proposta
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-button>
                @endif
            </div>
        </div>
    </div>

    <x-loading />
</div>
