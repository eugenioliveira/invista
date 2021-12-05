@component('mail::message')
# Lote Vendido!

Olá!

Informamos que o lote {{ $sale->lot->identification }} do loteamento {{ $sale->lot->allotment->title }} teve uma proposta
aceita e foi vendido.

Seguem os dados da venda:

@component('mail::panel')
**Corretor:** {{ $sale->user->name }};

**Comprador:** {{ $sale->salable->full_name }}

**Valor da venda:** R$ {{ $sale->value }}

**Condições:** {{ $sale->proposal->conditions }}
@endcomponent

@component('mail::button', ['url' => $sale->proposal->url])
Ir para a proposta
@endcomponent

@component('mail::button', ['url' => $sale->url])
Ir para a venda
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
