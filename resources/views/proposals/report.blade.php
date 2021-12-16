<x-report-layout title="Proposta #">

    <!-- Cabeçalho -->
    <div class='flex items-center'>
        <div class='flex-1'>
            <div class='w-full px-6 py-2 border border-black' style='border-width: 2px'>
                <p class='text-center text-2xl uppercase'>
                    Proposta de aquisição de lotes
                </p>
            </div>
        </div>
        <div class='flex items-center ml-4'>
            <x-logo width="80"></x-logo>
            <span class='uppercase'>Intervest</span>
        </div>
    </div>

    <!-- Corpo -->
    <div class='mt-4'>
        <table class='w-full border border-black' style='border-width: 2px'>
            <tr>
                <td colspan='4' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase text-center text-lg font-bold'>Dados do loteamento:</p>
                </td>
            </tr>
            <tr>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Loteamento: {{ $proposal->lot->allotment->title }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Quadra: {{ $proposal->lot->block }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Lote: {{ $proposal->lot->number }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Área (m²): {{ $proposal->lot->total }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='4' class='border border-black p-2 bg-gray-400' style='border-width: 2px'>
                    <p class='uppercase text-center text-lg font-bold'>Proponente:</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Nome: {{ $proposal->proposeable->full_name }}</p>
                </td>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Estado
                        Civil: {{ $proposal->proposeable->detail->civil_status->description }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Data de
                        Nascimento: {{ $proposal->proposeable->detail->birth_date->format('d/m/Y') }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Naturalidade: {{ $proposal->proposeable->detail->birth_location }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Nacionalidade: {{ $proposal->proposeable->detail->nationality }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>CPF: {{ $proposal->proposeable->cpf }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>RG: {{ $proposal->proposeable->detail->rg }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Órgão emissor: {{ $proposal->proposeable->detail->rg_issuer }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Profissão: {{ $proposal->proposeable->detail->occupation }}</p>
                </td>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p><span class='uppercase'>E-mail:</span> {{ $proposal->proposeable->detail->email }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Telefone: {{ $proposal->proposeable->phone }}</p>
                </td>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p><span class='uppercase'>Renda mensal:</span>
                        R$ {{ $proposal->proposeable->detail->monthly_income }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Nome do pai: {{ $proposal->proposeable->detail->father_name }}</p>
                </td>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Nome da mãe: {{ $proposal->proposeable->detail->mother_name }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='4' class='border border-black p-2 bg-gray-400' style='border-width: 2px'>
                    <p class='uppercase text-center text-lg font-bold'>Condições de pagamento:</p>
                </td>
            </tr>
            @if($proposal->type->is(\App\Enums\ProposalType::FREE))
                <tr>
                    <td colspan='4' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>{{ $proposal->comments }}</p>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Valor do lote: {{ $proposal->lot->formatted_price }}</p>
                    </td>
                    <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Valor de entrada: R$ {{ $proposal->down_payment }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Forma de pagamento: {{ $proposal->type->description }}</p>
                    </td>
                    <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Número de parcelas: {{ $proposal->installments }}</p>
                    </td>
                </tr>
                <tr>
                    <td class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Valor da parcela: R$ {{ $proposal->installment_value }}</p>
                    </td>
                    <td class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Data do primeiro pagamento: R$ {{ $proposal->payment_date->format('d/m/Y') }}</p>
                    </td>
                    <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                        <p class='uppercase'>Valor
                            total: {{ app('currency')->format(app('decimal')->parse($proposal->installments) * app('decimal')->parse($proposal->installment_value)) }}</p>
                    </td>
                </tr>
            @endif
        </table>

        <table class='w-full border border-black mt-4' style='border-width: 2px'>
            <tr>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Data: {{ $proposal->created_at->format('d/m/Y') }}</p>
                </td>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Corretor: {{ $proposal->user->name }}</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Assinatura Corretor:</p>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='border border-black p-2' style='border-width: 2px'>
                    <p class='uppercase'>Assinatura Proponente:</p>
                </td>
            </tr>
        </table>

        <table class='w-full border border-black mt-4' style='border-width: 2px'>
            <tr>
                <td class='border border-black p-2' style='border-width: 2px'>
                    <div class='text-justify'>
                        <span class='text-red-500 font-bold underline'>IMPORTANTE:</span> O presente pré-contrato
                        contendo a
                        proposta supra, juntamente com o pagamento referente ao SINAL/ARRAS, poderá ser pago através de
                        moeda corrente, depósito bancário ou cheque(s) nominal (is) e cruzado(s) á (VENDEDORA), no qual
                        posteriormente será encaminhado para a sede da empresa VENDEDORA. É de meu (nosso) conhecimento
                        que
                        a VENDEDORA tem o direito de recusá-la, ainda que imotivadamente. Declaro (amos) que estou
                        (amos)
                        ciente (s) que o respectivo contrato de compra e venda somente será confeccionado depois de
                        cumprida
                        a análise mencionada acima e demais formalidades pertinentes a esta aprovação. Concordo (amos)
                        que
                        vindo essa a ser aprovada, e caso o pagamento do SINAL/ARRAS tenha ocorrido através de cheque
                        (s),
                        os mesmo (s) será (ão) imediatamente apresentado (s) contra o banco (s) sacado (s) e sua regular
                        e
                        efetiva compensação bancária equivalerá ao pagamento da quantia correspondente ao(s) título(s).
                        A
                        quitação, por parte da VENDEDORA constará no contrato de compra e venda. Em caso de recusa dessa
                        proposta, ou ainda, em caso de devolução pelo (s) banco (s) sacado (s) do (s) cheque (s) acima
                        relacionado (s), tenho (temos) ciência que essa proposta perderá qualquer eficácia jurídica,
                        ficando
                        o imóvel totalmente liberado para comercialização. Ainda nessa hipótese, deverei (emos) retirar
                        junto a IMOBILIÁRIA essa via original da proposta de aquisição de lotes e do (s) cheque (s)
                        devovido
                        (s), se for o caso, mediante recibo.
                    </div>
                </td>
            </tr>
        </table>
    </div>

</x-report-layout>