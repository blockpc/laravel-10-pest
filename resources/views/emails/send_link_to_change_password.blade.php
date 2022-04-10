@component('mail::message')
Saludos **{{$user->name}}**.  {{-- use double space for line break --}}

El administrador de **{{ config('app.name') }}** te ha enviado un link para cambiar tu contraseña. 

El siguiente link, valido por una vez, te permitira crear una nueva clave para ingresar al sistema.

@component('mail::button', ['url' => url($url)])
Crear tu clave
@endcomponent

*El link es valido solo una vez. Si fallas comunicate con un administrador para que te envie otro link.*

Recuerda que puedes cambiar tu clave o tu correo desde la pagina de tu  **perfil**  

Saludos.<br>
{{ config('app.name') }} Team<br>
<small>No debes responder este correo</small>
@endcomponent