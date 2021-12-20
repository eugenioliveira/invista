<div>
    <form wire:submit.prevent="{{ $formAction }}">
        <x-imodal.dialog max-width="2xl" wire:model.defer="{{ $modalFlag }}">
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="content">
                <div class="overflow-auto pr-4" style="height: 700px;">

                    <h1 class="text-lg text-center font-bold">Dados pessoais</h1>

                    @include('livewire.proposal.inputs.basic')

                    <hr>

                    <div>
                        @if($address)
                            <h1 class="text-lg text-center font-bold">Endereço</h1>

                            @include('livewire.proposal.inputs.address')
                        @endif
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="button" wire:click="$set('{{ $modalFlag }}', false)">Cancelar</x-button>

                <x-button type="submit">{{ $buttonText }}</x-button>
            </x-slot>
        </x-imodal.dialog>
    </form>
</div>