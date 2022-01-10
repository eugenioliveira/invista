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

    <div class='mt-2 flex items-center'>
        <div>
            <strong>Loteamento: </strong> {{ $proposal->lot->allotment->title }}
        </div>
        <div class='ml-4'>
            <strong>Cidade: </strong> {{ $proposal->lot->allotment->city->full_name }}
        </div>
    </div>

    <div class='mt-2 flex items-center'>
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

    <div class='w-full mt-2 bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            Transferência
        </p>
    </div>

    <div class='mt-2 flex items-end'>
        <div>
            <strong>De: </strong>
        </div>
        <div class='w-full border-b border-black'></div>
    </div>

    <div class='w-full mt-2 bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            1º Proponente
        </p>
    </div>

    <div class='mt-2 flex items-center'>
        <div>
            <strong>Proponente: </strong> {{ $proposal->proposeable->full_name }}
        </div>
    </div>

    <div class='mt-2 flex items-center'>
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

    <div class='mt-2 flex items-center'>
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

    <div>
        @if($proposal->proposeable->detail->civil_status == \App\Enums\CivilStatus::MARRIED)
            <div class='mt-2 flex items-center'>
                <div>
                    <strong>Data de
                        Casamento: </strong> {{ $proposal->proposeable->detail->marriage_date->format('d/m/Y') }}
                </div>
                <div class='ml-4'>
                    <strong>Regime de casamento: </strong> {{ $proposal->proposeable->detail->marriage_regime }}
                </div>
            </div>
        @endif
    </div>

    <div class='mt-2 flex items-center'>
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

    <div class='mt-2 flex items-center'>
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

    <div class='mt-2 flex items-center'>
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

    <div class='mt-2 flex items-center'>
        <div>
            <strong>Nome do Pai: </strong> {{ $proposal->proposeable->detail->father_name }}
        </div>
        <div class='ml-4'>
            <strong>Nome da Mãe: </strong> {{ $proposal->proposeable->detail->mother_name }}
        </div>
    </div>

    @php $partner = $proposal->proposeable->detail->partner @endphp
    @if ($partner && $partner->detail)
        <div class='mt-2 flex items-center'>
            <div>
                <strong>Cônjuge: </strong> {{ $partner->full_name }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
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

        <div class='mt-2 flex items-center'>
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

        <div class='mt-2 flex items-center'>
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

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Nome do Pai: </strong> {{ $partner->detail->father_name }}
            </div>
            <div class='ml-4'>
                <strong>Nome da Mãe: </strong> {{ $partner->detail->mother_name }}
            </div>
        </div>
    @endif

    @forelse($proposal->proponents as $index => $proponent)
        <div class='w-full mt-2 bg-black py-1 rounded-md'>
            <p class='text-center text-white font-bold text-xl italic'>
                {{ $index + 2 }}º Proponente
            </p>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Proponente: </strong> {{ $proponent->full_name }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>CPF: </strong> {{ $proponent->cpf }}
            </div>
            <div class='ml-4'>
                <strong>RG: </strong> {{ $proponent->detail->rg }}
            </div>
            <div class='ml-4'>
                <strong>Data Emissão: </strong> {{ $proponent->detail->rg_issue_date->format('d/m/Y') }}
            </div>
            <div class='ml-4'>
                <strong>Órgão emissor: </strong> {{ $proponent->detail->rg_issuer }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Data de Nascimento: </strong> {{ $proponent->detail->birth_date->format('d/m/Y') }}
            </div>
            <div class='ml-4'>
                <strong>Estado Civil: </strong> {{ $proponent->detail->civil_status->description }}
            </div>
            <div class='ml-4'>
                <strong>Profissão: </strong> {{ $proponent->detail->occupation }}
            </div>
            <div class='ml-4'>
                <strong>Telefone: </strong> {{ $proponent->phone }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Naturalidade: </strong> {{ $proponent->detail->birth_location }}
            </div>
            <div class='ml-4'>
                <strong>Nacionalidade: </strong> {{ $proponent->detail->nationality }}
            </div>
            <div class='ml-4'>
                <strong>E-mail: </strong> {{ $proponent->detail->email }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Endereço: </strong> {{ $proponent->address->street }}
            </div>
            <div class='ml-4'>
                <strong>Nº: </strong> {{ $proponent->address->number }}
            </div>
            <div class='ml-4'>
                <strong>Complemento: </strong> {{ $proponent->address->apt_room }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Bairro: </strong> {{ $proponent->address->neighbourhood }}
            </div>
            <div class='ml-4'>
                <strong>Cidade: </strong> {{ $proponent->address->city }}
            </div>
            <div class='ml-4'>
                <strong>Estado: </strong> {{ $proponent->address->state }}
            </div>
            <div class='ml-4'>
                <strong>CEP: </strong> {{ $proponent->address->postal_code }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Nome do Pai: </strong> {{ $proponent->detail->father_name }}
            </div>
            <div class='ml-4'>
                <strong>Nome da Mãe: </strong> {{ $proponent->detail->mother_name }}
            </div>
        </div>

        @php $partner2 = $proponent->detail->partner @endphp
        @if ($partner2 && $partner2->detail)
            <div class='mt-2 flex items-center'>
                <div>
                    <strong>Cônjuge: </strong> {{ $partner2->full_name }}
                </div>
            </div>

            <div class='mt-2 flex items-center'>
                <div>
                    <strong>CPF: </strong> {{ $partner2->cpf }}
                </div>
                <div class='ml-4'>
                    <strong>RG: </strong> {{ $partner2->detail->rg }}
                </div>
                <div class='ml-4'>
                    <strong>Data Emissão: </strong> {{ $partner2->detail->rg_issue_date->format('d/m/Y') }}
                </div>
                <div class='ml-4'>
                    <strong>Órgão emissor: </strong> {{ $partner2->detail->rg_issuer }}
                </div>
            </div>

            <div class='mt-2 flex items-center'>
                <div>
                    <strong>Data de Nascimento: </strong> {{ $partner2->detail->birth_date->format('d/m/Y') }}
                </div>
                <div class='ml-4'>
                    <strong>Estado Civil: </strong> {{ $partner2->detail->civil_status->description }}
                </div>
                <div class='ml-4'>
                    <strong>Profissão: </strong> {{ $partner2->detail->occupation }}
                </div>
                <div class='ml-4'>
                    <strong>Telefone: </strong> {{ $partner2->phone }}
                </div>
            </div>

            <div class='mt-2 flex items-center'>
                <div>
                    <strong>Naturalidade: </strong> {{ $partner2->detail->birth_location }}
                </div>
                <div class='ml-4'>
                    <strong>Nacionalidade: </strong> {{ $partner2->detail->nationality }}
                </div>
                <div class='ml-4'>
                    <strong>E-mail: </strong> {{ $partner2->detail->email }}
                </div>
            </div>

            <div class='mt-2 flex items-center'>
                <div>
                    <strong>Nome do Pai: </strong> {{ $partner2->detail->father_name }}
                </div>
                <div class='ml-4'>
                    <strong>Nome da Mãe: </strong> {{ $partner2->detail->mother_name }}
                </div>
            </div>
        @endif
    @empty
    @endforelse

    <div class='w-full mt-2 bg-black py-1 rounded-md'>
        <p class='text-center text-white font-bold text-xl italic'>
            Plano de pagamento
        </p>
    </div>

    @if ($proposal->type->is(\App\Enums\ProposalType::IN_CASH) || $proposal->type->is(\App\Enums\ProposalType::INSTALLMENTS))
        <div class='mt-2 flex items-center'>
            <div>
                <strong>Valor negociado: </strong> {{ $proposal->negotiated_value }}
            </div>
        </div>
        <div class='mt-2 flex items-center'>
            <div>
                <strong>Entrada/Sinal: </strong>R$ {{ $proposal->down_payment }}
            </div>
            <div class='ml-4'>
                <strong>Data da entrada: </strong> {{ $proposal->payment_date->format('d/m/Y') }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Saldo restante: </strong>
                R$ {{ app('decimal')->format(app('decimal')->parse($proposal->negotiated_value) - app('decimal')->parse($proposal->down_payment)) }}
            </div>
            <div class='ml-4'>
                <strong>Quantidade de prestações: </strong>{{ $proposal->installments }}
            </div>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                <strong>Valor da prestação: </strong> R$ {{ $proposal->installment_value }}
            </div>
            @if ($proposal->installment_date)
                <div class='ml-4'>
                    <strong>Data da primeira parcela: </strong>{{ $proposal->installment_date->format('d/m/Y') }}
                </div>
            @endif
        </div>
    @else
        <div class='mt-2 flex items-center'>
            <div>
                <strong>Condições: </strong> {{ $proposal->conditions }}
            </div>
        </div>
    @endif

    @if($proposal->comments)
        <div class='w-full mt-2 bg-black py-1 rounded-md'>
            <p class='text-center text-white font-bold text-xl italic'>
                Observações sobre a proposta
            </p>
        </div>

        <div class='mt-2 flex items-center'>
            <div>
                {{ $proposal->comments }}
            </div>
        </div>
    @endif

    <div class='w-full mt-2 bg-black py-1 rounded-md p-2'>
        <p class='text-justify text-white font-bold text-xl italic'>
            Observação: Os contratos serão corrigidos anualmente pela variação do índice IGP-M/FGV-SP.
            O proponente declara que as informações contidas nesta proposta são verdadeiras e de inteira
            responsabilidade do mesmo.
        </p>
    </div>

    <div class='mt-2 flex items-center'>
        <div class="flex flex-1 items-end">
            <div>
                <strong>Local: </strong>
            </div>
            <div class='w-full border-b border-black'></div>
        </div>

        <div>
            <strong>Data: </strong> {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <div class="w-full flex items-center mt-2">

        <div class='w-2/3'>
            <p class='my-6'><strong>Assinatura Proponente 1:</strong>____________________________________________</p>
            @if($proposal->proposeable->detail->partner)
                <p class='my-6'><strong>Assinatura Cônjuge Proponente 1:</strong>____________________________________________
                </p>
            @endif
            @forelse($proposal->proponents as $index => $proponent)
                <p class='my-6'><strong>Assinatura Proponente {{ $index + 2 }}:</strong>____________________________________________
                </p>
                @if($proponent->detail->partner)
                    <p class='my-6'><strong>Assinatura Cônjuge Proponente {{ $index + 2 }}:</strong>____________________________________________
                    </p>
                @endif
            @empty
            @endforelse
        </div>

        <div class='w-1/3'>
            <p class='my-6'><strong>Assinatura Corretor:</strong>____________________________________________</p>
        </div>
    </div>

    <!-- Rodapé -->
    @include('proposals.timbre')

</x-report-layout>