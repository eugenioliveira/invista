<x-report-layout title="Proposta #">

    <!-- Cabeçalho -->
    @include('proposals.timbre')

    <div class='my-4 pb-3 flex items-center border-black border-b'>
        <span class='text-xl font-bold'>Declara Imposto de Renda</span>
        <div class='w-10 h-10 ml-4 border border-black'></div>
        <span class='text-xl ml-2 font-bold'>Sim</span>
        <div class='w-10 h-10 ml-4 border border-black'></div>
        <span class='text-xl ml-2 font-bold'>Não</span>
    </div>

    <div class='mb-4 flex items-center'>
        <div class='w-10 h-10 border border-black'></div>
        <span class='ml-2'>Proposta de Aquisição de Lotes</span>
        <div class='w-10 h-10 ml-4 border border-black'></div>
        <span class='ml-2'>Proposta Para Transferência de Contrato</span>
    </div>

    <div class='w-full bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            Proposta Sujeita À Aprovação <br>
            Especificação
        </p>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Loteamento: </strong> {{ $proposal->lot->allotment->title }}
        </div>
        <div class='ml-4'>
            <strong>Cidade: </strong> {{ $proposal->lot->allotment->city->full_name }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Lote Nº: </strong> {{ $proposal->lot->number }}
        </div>
        <div class='ml-4'>
            <strong>Quadra: </strong> {{ $proposal->lot->block }}
        </div>
        <div class='ml-4'>
            <strong>M²: </strong> {{ $proposal->lot->total }}
        </div>
        <div class='ml-4'>
            <strong>Valor de tabela: </strong>R$ {{ $proposal->lot->price }}
        </div>
    </div>

    <div class='w-full mt-3 bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            Transferência
        </p>
    </div>

    <div class='mt-3 flex items-end'>
        <div>
            <strong>De: </strong>
        </div>
        <div class='w-full border-b border-black'></div>
    </div>

    <div class='w-full mt-3 bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            1º Proponente
        </p>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Proponente: </strong> {{ $proposal->proposeable->full_name }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>CPF: </strong> {{ $proposal->proposeable->cpf }}
        </div>
        <div class='ml-4'>
            <strong>RG: </strong> {{ $proposal->proposeable->detail->rg }}
        </div>
        <div class='ml-4'>
            <strong>Data Emissão: </strong> {{ $proposal->proposeable->detail->rg_issue_date->format('d/m/Y') }}
        </div>
        <div class='ml-4'>
            <strong>Órgão emissor: </strong> {{ $proposal->proposeable->detail->rg_issuer }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Data de Nascimento: </strong> {{ $proposal->proposeable->detail->birth_date->format('d/m/Y') }}
        </div>
        <div class='ml-4'>
            <strong>Estado Civil: </strong> {{ $proposal->proposeable->detail->civil_status->description }}
        </div>
        <div class='ml-4'>
            <strong>Profissão: </strong> {{ $proposal->proposeable->detail->occupation }}
        </div>
        <div class='ml-4'>
            <strong>Telefone: </strong> {{ $proposal->proposeable->phone }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Naturalidade: </strong> {{ $proposal->proposeable->detail->birth_location }}
        </div>
        <div class='ml-4'>
            <strong>Nacionalidade: </strong> {{ $proposal->proposeable->detail->nationality }}
        </div>
        <div class='ml-4'>
            <strong>E-mail: </strong> {{ $proposal->proposeable->detail->email }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Endereço: </strong> {{ $proposal->proposeable->address->street }}
        </div>
        <div class='ml-4'>
            <strong>Nº: </strong> {{ $proposal->proposeable->address->number }}
        </div>
        <div class='ml-4'>
            <strong>Complemento: </strong> {{ $proposal->proposeable->address->apt_room }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Bairro: </strong> {{ $proposal->proposeable->address->neighbourhood }}
        </div>
        <div class='ml-4'>
            <strong>Cidade: </strong> {{ $proposal->proposeable->address->city }}
        </div>
        <div class='ml-4'>
            <strong>Estado: </strong> {{ $proposal->proposeable->address->state }}
        </div>
        <div class='ml-4'>
            <strong>CEP: </strong> {{ $proposal->proposeable->address->postal_code }}
        </div>
    </div>

    <div class='mt-3 flex items-center'>
        <div>
            <strong>Nome do Pai: </strong> {{ $proposal->proposeable->detail->father_name }}
        </div>
        <div class='ml-4'>
            <strong>Nome da Mãe: </strong> {{ $proposal->proposeable->detail->mother_name }}
        </div>
    </div>

    @php $partner = $proposal->proposeable->detail->partner @endphp
    @if ($partner && $partner->detail)
        <div class='mt-3 flex items-center'>
            <div>
                <strong>Cônjuge: </strong> {{ $partner->full_name }}
            </div>
        </div>

        <div class='mt-3 flex items-center'>
            <div>
                <strong>CPF: </strong> {{ $partner->cpf }}
            </div>
            <div class='ml-4'>
                <strong>RG: </strong> {{ $partner->detail->rg }}
            </div>
            <div class='ml-4'>
                <strong>Data Emissão: </strong> {{ $partner->detail->rg_issue_date->format('d/m/Y') }}
            </div>
            <div class='ml-4'>
                <strong>Órgão emissor: </strong> {{ $partner->detail->rg_issuer }}
            </div>
        </div>

        <div class='mt-3 flex items-center'>
            <div>
                <strong>Data de Nascimento: </strong> {{ $partner->detail->birth_date->format('d/m/Y') }}
            </div>
            <div class='ml-4'>
                <strong>Estado Civil: </strong> {{ $partner->detail->civil_status->description }}
            </div>
            <div class='ml-4'>
                <strong>Profissão: </strong> {{ $partner->detail->occupation }}
            </div>
            <div class='ml-4'>
                <strong>Telefone: </strong> {{ $partner->phone }}
            </div>
        </div>

        <div class='mt-3 flex items-center'>
            <div>
                <strong>Naturalidade: </strong> {{ $partner->detail->birth_location }}
            </div>
            <div class='ml-4'>
                <strong>Nacionalidade: </strong> {{ $partner->detail->nationality }}
            </div>
            <div class='ml-4'>
                <strong>E-mail: </strong> {{ $partner->detail->email }}
            </div>
        </div>

        <div class='mt-3 flex items-center'>
            <div>
                <strong>Nome do Pai: </strong> {{ $partner->detail->father_name }}
            </div>
            <div class='ml-4'>
                <strong>Nome da Mãe: </strong> {{ $partner->detail->mother_name }}
            </div>
        </div>
    @endif


    <!-- Rodapé -->
    @include('proposals.timbre')

</x-report-layout>