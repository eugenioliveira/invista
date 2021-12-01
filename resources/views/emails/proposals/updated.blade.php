@component('mail::message')
# Proposta #{{ $proposal->id }} atualizada

Olá.

A proposta #{{ $proposal->id }}, para o lote **{{ $proposal->lot->identification }}**,
do loteamento **{{ $proposal->lot->allotment->title }}**, teve seus dados atualizados.

Seguem, abaixo, os dados atualizados:

@component('mail::panel')
**Tipo de proposta:** {{ $proposal->type->description }}

**Condições da proposta:** {{ $proposal->conditions }}
@endcomponent

Seguem, em anexo, os documentos anexados à proposta.

@component('mail::button', ['url' => $proposal->url])
Ir para a proposta
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
