<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\Inventario;

class InventarioController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $bodegas = Bodega::all();
        return view('modificar-inventario', compact('productos', 'bodegas'));
    }

    public function modificar(Request $request)
    {
        $request->validate([
            'producto' => 'required|exists:productos,id',
            'bodega' => 'required|exists:bodegas,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $inventario = Inventario::updateOrCreate(
            [
                'producto_id' => $request->producto,
                'bodega_id' => $request->bodega,
            ],
            [
                'cantidad' => $request->cantidad,
            ]
        );

        return redirect()->route('inventario.index')->with('success', 'Inventario modificado correctamente.');
    }

    // Muestra un registro específico de inventario
    public function show($id)
    {
        $inventario = Inventario::findOrFail($id);
        return response()->json($inventario);
    }

    // Crea un nuevo registro de inventario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'bodega_id' => 'required|exists:bodegas,id',
            'cantidad' => 'required|integer|min:0',
        ]);

        $inventario = Inventario::create($validated);
        return response()->json($inventario, 201);
    }

    // Actualiza un registro existente de inventario
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'producto_id' => 'exists:productos,id',
            'bodega_id' => 'exists:bodegas,id',
            'cantidad' => 'integer|min:0',
        ]);

        $inventario = Inventario::findOrFail($id);
        $inventario->update($validated);
        return response()->json($inventario);
    }

    // Elimina un registro de inventario
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return response()->json(['message' => 'Registro eliminado correctamente']);
    }
}
