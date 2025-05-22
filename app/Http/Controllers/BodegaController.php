<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener instalado barryvdh/laravel-dompdf

class BodegaController extends Controller
{
    public function index()
    {
        // Cargar bodegas con inventario y productos relacionados
        $bodegas = Bodega::with(['inventario.producto', 'responsable'])->get();

        // Pasar los datos a la vista
        return view('bodega', [
            'bodegas' => $bodegas,
            'usuarios' => User::all(), // Asegúrate de cargar los usuarios para el formulario
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicación' => 'required|string|max:255',
            'responsable_id' => 'required|integer|exists:users,id',
        ]);

        Bodega::create([
            'nombre' => $request->nombre,
            'ubicación' => $request->ubicación,
            'responsable_id' => $request->responsable_id,
        ]);

        return redirect()->back()->with('success', 'Bodega creada exitosamente.');
    }

    public function generarReporte($id)
    {
        $bodega = Bodega::with(['responsable', 'inventario.producto'])->findOrFail($id);

        $pdf = Pdf::loadView('reportes.bodega', compact('bodega'));
        return $pdf->download('reporte_bodega_' . $bodega->id . '.pdf');
    }
}
