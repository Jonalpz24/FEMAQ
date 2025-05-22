<?php

namespace App\Http\Controllers;

use App\Models\ReporteEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteEnvioMail;

class ReporteEnvioController extends Controller
{
    public function index()
    {
        $reportes_envio = ReporteEnvio::all();
        return view('reporte_envio.index', compact('reportes_envio'));
    }

    public function show($id)
    {
        $reporte = ReporteEnvio::findOrFail($id);
        return view('reporte_envio.show', compact('reporte'));
    }

    public function generarPDF($id)
    {
        $reporte = ReporteEnvio::with('detalles')->findOrFail($id); // Asegúrate de cargar las relaciones necesarias
        $pdf = \PDF::loadView('pdf.reporte_envio', compact('reporte'));
        return $pdf->download('reporte_envio.pdf');
    }

    public function enviarPorCorreo(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $reporte = ReporteEnvio::findOrFail($id);

        // Generar el PDF
        $pdf = \PDF::loadView('pdf.reporte_envio', compact('reporte'));

        // Enviar el correo
        Mail::to($request->email)->send(new ReporteEnvioMail($reporte, $pdf));

        return redirect()->back()->with('success', 'El reporte ha sido enviado por correo.');
    }
}