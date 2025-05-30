<?php
namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ContratoController extends Controller
{
    
    public function index()
{
    $contratos = Contrato::with(['cliente', 'producto'])->get();
    $clientes = Cliente::all();
    $productos = Producto::all();

    return view('contratos.contratos', compact('contratos', 'clientes', 'productos'));
}


    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('contratos.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'fecha_contrato' => 'nullable|date',
    ]);

    $producto = Producto::findOrFail($request->producto_id);
    $total_costo = $producto->precio_unitario * $request->cantidad;

    Contrato::create([
        'cliente_id' => $request->cliente_id,
        'producto_id' => $request->producto_id,
        'cantidad' => $request->cantidad,
        'fecha_contrato' => $request->fecha_contrato,
        'total_costo' => $total_costo,
    ]);

    return redirect()->route('contratos.contratos')->with('success', 'Contrato creado con éxito.');
}


    public function edit(Contrato $contrato)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('contratos.edit', compact('contrato', 'clientes', 'productos'));
    }

    public function update(Request $request, Contrato $contrato)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'producto_id' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'fecha_contrato' => 'nullable|date',
    ]);

    $producto = Producto::findOrFail($request->producto_id);
    $total_costo = $producto->precio_unitario * $request->cantidad;

    $contrato->update([
        'cliente_id' => $request->cliente_id,
        'producto_id' => $request->producto_id,
        'cantidad' => $request->cantidad,
        'fecha_contrato' => $request->fecha_contrato,
        'total_costo' => $total_costo,
    ]);

    return redirect()->route('contratos.contratos')->with('success', 'Contrato actualizado con éxito.');
}


    public function destroy(Contrato $contrato)
    {
        $contrato->delete();

        return redirect()->route('contratos.contratos')->with('success', 'Contrato eliminado con éxito.');
    }
    
public function generarPDF(Contrato $contrato)
{
    $contrato->load(['cliente', 'producto']);
    $pdf = Pdf::loadView('contratos.pdf', compact('contrato'));
    return $pdf->stream("contrato-{$contrato->id}.pdf");
}
}
