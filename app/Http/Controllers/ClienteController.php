<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }



    // Guardar nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente añadido con éxito.');
    }

    // Mostrar formulario de edición
    public function edit($id)
{
    $cliente = Cliente::findOrFail($id);
    return view('clientes.edit', compact('cliente'));
}

    // Actualizar cliente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    // Eliminar cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }
}
