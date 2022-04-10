@component('mail::message')
Saludos **{{$company->name}}**.  {{-- use double space for line break --}}

El administrador de **{{ config('app.name') }}** te ha enviado un mensaje. 

@component('mail::panel')
{!! nl2br($content) !!}
@endcomponent

Saludos.<br>
{{ config('app.name') }}

<small>Este correo fue enviado a **{{$company->name}}**</small>
@endcomponent