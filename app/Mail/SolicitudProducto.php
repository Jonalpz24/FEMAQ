<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudProducto extends Mailable
{
    use Queueable, SerializesModels;

    public $producto;
public $pdf;

public function __construct($producto, $pdf)
{
    $this->producto = $producto;
    $this->pdf = $pdf;
}

public function build()
{
    return $this->subject('Solicitud de Renta de Producto')
                ->markdown('emails.solicitud')
                ->attachData($this->pdf, 'solicitud.pdf', ['mime' => 'application/pdf']);
}

}
