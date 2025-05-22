<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripción' => 'nullable|string',
            'unidad_medida' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'descripción' => $request->descripción,
            'unidad_medida' => $request->unidad_medida,
            'precio_unitario' => $request->precio_unitario,
        ]);

        return redirect('/crear')->with('success', 'Producto añadido con éxito.');
    }
}
