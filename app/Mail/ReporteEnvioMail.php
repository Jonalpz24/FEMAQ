<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteEnvioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reporte;
    public $pdf;

    public function __construct($reporte, $pdf)
    {
        $this->reporte = $reporte;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->view('emails.reporte_envio')
                    ->subject('Reporte de Envío')
                    ->attachData($this->pdf->output(), 'reporte_envio.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
