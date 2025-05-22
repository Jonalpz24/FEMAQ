<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\BodegaController; // Importar el controlador
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ReporteEnvioController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

Route::get('/crear', function () {
    return view('crear');
});

Route::post('/crear', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/orden', [OrdenController::class, 'create']);
Route::post('/orden', [OrdenController::class, 'store']);
Route::get('/api/inventario', [OrdenController::class, 'getProductosPorBodega']);
Route::get('/reporte-envio/pdf/{id}', [ReporteEnvioController::class, 'generarPDF'])->name('reporte-envio.pdf');
Route::get('/reporte-envio/email/{id}', [ReporteEnvioController::class, 'enviarPorCorreo'])->name('reporte-envio.email');
Route::post('/reporte-envio/email/{id}', [ReporteEnvioController::class, 'enviarPorCorreo'])->name('reporte-envio.email');

require __DIR__.'/auth.php';
