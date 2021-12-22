<div>
    <form wire:submit.prevent="{{ $formAction }}">
        <x-imodal.dialog max-width="2xl" wire:model.defer="{{ $modalFlag }}">
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="content">
                <div class="overflow-auto pr-4" style="max-height: 75vh">

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
                <div class="flex justify-end items-center space-x-2">
                    <div>
                        @if($errors->isNotEmpty())
                            <div class="text-red-700">Atenção: há algum erro em algum campo.</div>
                        @endif
                    </div>
                    <x-button type="button" wire:click="$set('{{ $modalFlag }}', false)">Cancelar</x-button>

                    <x-button type="submit">{{ $buttonText }}</x-button>
                </div>
            </x-slot>
        </x-imodal.dialog>
    </form>
</div>