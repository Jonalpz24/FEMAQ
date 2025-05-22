<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Orden; // Cambiar a Orden
use App\Models\DetalleReporteEnvio;
use Illuminate\Support\Facades\Auth; // Importar Auth para obtener el usuario autenticado
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener DomPDF instalado

class OrdenController extends Controller
{
    public function create()
    {
        $bodegas = Bodega::all();
        $inventarios = Inventario::with('producto')->get(); // Asegúrate de cargar la relación 'producto'
        $reportes_envio = Orden::all(); // Obtener todos los reportes de envío desde la tabla 'reportes_envio'
        
        return view('orden', compact('bodegas', 'inventarios', 'reportes_envio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bodega' => 'required|exists:bodegas,id',
            'proveedor' => 'required|string|max:255', // Validar el campo proveedor
            'fecha' => 'required|date', // Validar el campo fecha
            'productos' => 'required|array',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'required|array',
            'cantidades.*' => 'integer|min:1',
        ]);

        $bodegaId = $request->input('bodega');
        $proveedor = $request->input('proveedor'); // Obtener el proveedor
        $fecha = $request->input('fecha'); // Obtener la fecha
        $productos = $request->input('productos');
        $cantidades = $request->input('cantidades');
        $totalEnvio = 0;

        // Crear la orden
        $orden = Orden::create([ // Cambiar a Orden
            'bodega_id' => $bodegaId,
            'proveedor' => $proveedor, // Incluir el proveedor
            'fecha' => $fecha, // Insertar la fecha
            'total_envio' => 0, // Se actualizará más tarde
            'creado_por' => Auth::id(), // Asignar el ID del usuario autenticado
        ]);

        // Validar que los arreglos productos y cantidades tengan el mismo tamaño
        if (count($productos) !== count($cantidades)) {
            return redirect()->back()->withErrors(['error' => 'La cantidad de productos y cantidades no coincide.']);
        }

        // Agregar productos a la orden
        foreach ($productos as $index => $productoId) {
            $cantidad = $cantidades[$index];

            // Verificar si hay suficiente inventario
            $inventario = Inventario::where('bodega_id', $bodegaId)
                ->where('producto_id', $productoId)
                ->first();

            if (!$inventario || $inventario->cantidad < $cantidad) {
                return redirect()->back()->withErrors(['error' => "Cantidad insuficiente en el inventario para el producto ID: $productoId."]);
            }

            // Restar cantidad del inventario
            $inventario->cantidad -= $cantidad;
            $inventario->save();

            // Obtener el precio del producto
            $producto = Producto::find($productoId);
            $precioUnitario = $producto->precio; // Asegurar que se obtenga el precio del producto

            // Crear el detalle de la orden
            DetalleReporteEnvio::create([
                'reporte_envio_id' => $orden->id, // Cambiar 'orden_id' por 'reporte_envio_id'
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio_unitario' => $precioUnitario,
            ]);

            $totalEnvio += $precioUnitario * $cantidad; // Sumar al total del envío
        }

        // Actualizar total_envio de la orden
        $orden->update(['total_envio' => $totalEnvio]); // Usar update para asegurarse de que se guarde correctamente

        return redirect()->back()->with('success', 'Orden generada exitosamente.');
    }

    public function generarPDF($id)
    {
        $reporte = Orden::with('detalles.producto')->findOrFail($id); // Asegurarse de que 'detalles' use 'reporte_envio_id'

        $pdf = Pdf::loadView('reporte_envio', compact('reporte')); // Actualizar la referencia a la vista
        return $pdf->download('reporte_envio_' . $id . '.pdf');
    }
}
