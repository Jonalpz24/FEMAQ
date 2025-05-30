<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


@component('mail::message')
# Nueva Solicitud de Renta

Se ha solicitado la renta del producto **{{ $producto->nombre }}**.

Revisa el archivo PDF adjunto para más detalles.

@endcomponent
