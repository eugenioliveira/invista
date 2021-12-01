@component('mail::message')
# Uma nova proposta foi enviada

Olá.

Recebemos uma nova proposta #{{ $proposal->id }}, para o lote **{{ $proposal->lot->identification }}**,
do loteamento **{{ $proposal->lot->allotment->title }}**.

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
