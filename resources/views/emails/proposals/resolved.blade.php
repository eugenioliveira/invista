@component('mail::message')
# {{ $proposal->user->name }}, sua proposta foi avaliada.

Olá, {{ $proposal->user->name }}.

A proposta #{{ $proposal->id }}, feita para o lote {{ $proposal->lot->identification }},
do loteamento {{ $proposal->lot->allotment->title }}, do tipo {{ $proposal->type->description }}, com as condições
{{ $proposal->conditions }}, foi avaliada por um administrador.

@component('mail::panel')
Seu novo status é: {{ $proposalStatus->type->description }}

O motivo da avaliação é: {{ $proposalStatus->reason }}
@endcomponent

Seguem, em anexo, os documentos anexados à proposta.

@component('mail::button', ['url' => $proposal->url])
Ir para a proposta
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
