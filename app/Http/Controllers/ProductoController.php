<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Mail\SolicitudProducto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;


class ProductoController extends Controller
{
    public function store(Request $request)
    {
        // Validar campos incluyendo imagen_url como URL opcional
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripción' => 'nullable|string',
            'unidad_medida' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
            'imagen_url' => 'nullable|url|max:2048', // <-- aquí
        ]);

        // Crear producto con imagen_url incluida
        Producto::create([
            'nombre' => $request->nombre,
            'descripción' => $request->descripción,
            'unidad_medida' => $request->unidad_medida,
            'precio_unitario' => $request->precio_unitario,
            'imagen_url' => $request->imagen_url, // <-- aquí
        ]);

        return redirect('/crear')->with('success', 'Producto añadido con éxito.');
    }
    public function create()
{
    $productos = Producto::all();
    return view('crear', compact('productos'));
}

// Mostrar formulario de edición
    public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $productos = Producto::all();
    return view('productos.edit', compact('producto'));

}


    // Actualizar producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripción' => 'nullable|string',
            'unidad_medida' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $producto->update([
    'nombre' => $request->nombre,
    'descripción' => $request->descripción,
    'unidad_medida' => $request->unidad_medida,
    'precio_unitario' => $request->precio_unitario,
    'imagen_url' => $request->imagen_url, 
]);

        return redirect('/crear')->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect('/crear')->with('success', 'Producto eliminado con éxito.');
    }
    public function updateField(Request $request, Producto $producto, $field)
{
    $camposPermitidos = ['nombre', 'descripción', 'unidad_medida', 'precio_unitario', 'imagen_url'];

    if (!in_array($field, $camposPermitidos)) {
        return back()->with('error', 'Campo no permitido.');
    }

    $producto->$field = $request->input('value');
    $producto->save();

    return back()->with('success', 'Campo actualizado correctamente.');
}
public function solicitar(Producto $producto)
{
    $pdf = Pdf::loadView('pdf.producto', compact('producto'));

    Mail::to('rentas@tuempresa.com')->send(new SolicitudProducto($producto, $pdf->output()));

    return redirect()->back()->with('success', 'Solicitud enviada correctamente.');
}

}
