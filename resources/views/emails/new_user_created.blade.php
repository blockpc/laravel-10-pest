@component('mail::message')
Saludos **{{$user->name}}**.  {{-- use double space for line break --}}

El administrador de **{{ $company }}** ha creado una cuenta para ti. 

@component('mail::table')
| **Correo**           | **Role**         |
|:---------------------|:------------------|
| **{{$user->email}}** | **{{$role}}** |
@endcomponent

El siguiente link, valido por una vez, te permitira crear una clave para ingresar al sistema.

@component('mail::button', ['url' => url($url)])
Crear tu clave
@endcomponent

*El link es valido solo una vez. Si fallas comunicate con un administrador para que te envie otro link.*

Recuerda que puedes cambiar tu clave o tu correo desde la pagina de tu  **perfil**  

Saludos.<br>
{{ $company }} Team<br>
<small>No debes responder este correo</small>
@endcomponent