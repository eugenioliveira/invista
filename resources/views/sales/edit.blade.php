<x-app-layout title="Adicionar contrato à venda #{{ $sale->id }}">

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-header-text>Adicionar contrato à venda #{{ $sale->id }}</x-header-text>
        </div>
    </x-slot>

    <x-section>
        <x-card class="p-4 max-w-3xl mx-auto">
            <form action='{{ route('sales.storecontract', $sale->id) }}' method='post' enctype='multipart/form-data'>
                @csrf
                @if($sale->contract)
                    <x-alert
                            :autoclose='false'
                            message='Atenção: a venda já possui um contrato associado. Fazer o upload de um novo contrato sobrescreverá o atual.'>
                    </x-alert>
                @endif
                <x-input-row class='mt-6'>
                    <input type="file" id='contract' name='contract' accept="application/pdf" />
                </x-input-row>
                @error('contract')
                <x-alert
                        :autoclose='false'
                        message='{{ $message }}'>
                </x-alert>
                @enderror
                <x-input-row class='mt-6'>
                    <x-button type='submit'>Enviar contrato</x-button>
                </x-input-row>
            </form>
        </x-card>
    </x-section>

</x-app-layout>