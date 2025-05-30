<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('dashboard', compact('productos'));
    }
}
