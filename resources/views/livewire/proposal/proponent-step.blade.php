<div>
    <div class="p-2 space-y-2">
        <h1 class="text-lg text-center font-bold">Lista de proponentes</h1>
        <div>
            @if($errors->first('general_error'))
                <x-alert type="danger" :autoclose="false">{{ $errors->first('general_error') }}</x-alert>
            @endif
        </div>
        <div>
            @if(!empty($proponents))
                <div class="flex flex-col space-y-4">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Nome</x-table.heading>
                            <x-table.heading>CPF</x-table.heading>
                            <x-table.heading></x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($proponents as $index => $proponent)
                                <x-table.row>
                                    <x-table.cell>{{ $proponent['first_name'] }} {{ $proponent['last_name'] }}</x-table.cell>
                                    <x-table.cell>{{ $proponent['cpf'] }}</x-table.cell>
                                    <x-table.cell>
                                        <div class="flex space-x-2">
                                            <div>
                                                @if($proponent['detail']['civil_status'] == \App\Enums\CivilStatus::MARRIED && empty($proponent['partner']))
                                                    <x-button type="button" wire:click="addPartner({{ $index }})">
                                                        Adicionar cônjuge
                                                    </x-button>
                                                @endif
                                            </div>
                                            <div>
                                                <x-button wire:click="editProponent({{ $index }})" type="button">
                                                    Editar
                                                </x-button>
                                            </div>
                                            <div>
                                                <x-button wire:click="removeProponent({{ $index }})" type="button">
                                                    Excluir
                                                </x-button>
                                            </div>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            @else
                Nenhum proponente cadastrado ainda. Clique no botão "Adicionar proponente" para adicionar.
            @endif
        </div>
        <div class="text-center">
            <x-button type="button" wire:click="$toggle('showProponentModal')">Adicionar proponente</x-button>
        </div>
    </div>

    <!-- Add Proponent Form -->
    <x-proposal-person-modal
            title="Adicionar proponente"
            :address="true"
            form-action="addProponent"
            modal-flag="showProponentModal"
            button-text="Adicionar"
    />

    <!-- Edit Proponent Form -->
    <x-proposal-person-modal
            title="Editar proponente"
            :address="true"
            form-action="updateProponent"
            modal-flag="showEditProponentModal"
            button-text="Atualizar"
    />

    <!-- Partner Form -->
    <x-proposal-person-modal
            title="Adicionar cônjuge"
            :address="false"
            form-action="storePartner"
            modal-flag="showPartnerModal"
            button-text="Adicionar"
    />

    <x-loading />
</div>
