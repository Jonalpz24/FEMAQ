<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\BodegaController; // Importar el controlador
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ReporteEnvioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::middleware('guest')->group(function () {
    Volt::route('/login', 'auth.login')->name('login');
    Volt::route('/register', 'auth.register')->name('register');
    Volt::route('/forgot-password', 'auth.forgot-password')->name('password.request');
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/productos/{producto}/solicitar', [ProductoController::class, 'solicitar'])->name('productos.solicitar');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('dashboard/bodegas', function () {
        $bodegas = \App\Models\Bodega::all();
        return view('dashboard.bodega', compact('bodegas'));
    })->name('dashboard.bodega');
});

Route::get('/bodegas', [BodegaController::class, 'index'])->name('bodegas.index');
Route::post('/bodegas', [BodegaController::class, 'store'])->name('bodegas.store');
Route::get('/bodegas/{id}/reporte', [BodegaController::class, 'generarReporte'])->name('bodegas.reporte');

Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::post('/inventario', [InventarioController::class, 'modificar'])->name('inventario.modificar');

Route::get('/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/crear', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::patch('/productos/{producto}/actualizar/{field}', [ProductoController::class, 'updateField'])->name('productos.updateField');

Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.contratos');
Route::get('/contratos/create', [ContratoController::class, 'create'])->name('contratos.create');
Route::post('/contratos', [ContratoController::class, 'store'])->name('contratos.store');
Route::get('/contratos/{contrato}/edit', [ContratoController::class, 'edit'])->name('contratos.edit');
Route::put('/contratos/{contrato}', [ContratoController::class, 'update'])->name('contratos.update');
Route::delete('/contratos/{contrato}', [ContratoController::class, 'destroy'])->name('contratos.destroy');
Route::get('/contratos/{contrato}/pdf', [ContratoController::class, 'generarPDF'])->name('contratos.pdf');

Route::post('/productos/{id}/solicitar', [ProductoController::class, 'solicitar'])->name('productos.solicitar');


Route::resource('clientes', ClienteController::class);
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/orden', [OrdenController::class, 'create']);
Route::post('/orden', [OrdenController::class, 'store']);
Route::get('/api/inventario', [OrdenController::class, 'getProductosPorBodega']);
Route::get('/reporte-envio/pdf/{id}', [ReporteEnvioController::class, 'generarPDF'])->name('reporte-envio.pdf');
Route::get('/reporte-envio/email/{id}', [ReporteEnvioController::class, 'enviarPorCorreo'])->name('reporte-envio.email.get');
Route::post('/reporte-envio/email/{id}', [ReporteEnvioController::class, 'enviarPorCorreo'])->name('reporte-envio.email.post');


require __DIR__.'/auth.php';
