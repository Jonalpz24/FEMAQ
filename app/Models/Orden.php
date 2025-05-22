<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'reportes_envio';

    // Definir los campos que son asignables masivamente
    protected $fillable = [
        'proveedor',    // Proveedor de la orden
        'fecha',        // Fecha de la orden
        'total_envio',  // Total del envío
        'creado_por',   // Usuario que creó la orden
    ];

    // Relación con el usuario que creó la orden
    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    // Relación con los detalles de la orden
    public function detalles()
    {
        return $this->hasMany(DetalleReporteEnvio::class, 'reporte_envio_id'); // Relación con los detalles
    }
}
