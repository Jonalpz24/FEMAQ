<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteEnvio extends Model
{
    use HasFactory;

    protected $table = 'reportes_envio';

    protected $fillable = [
        'fecha_envio',
        'bodega_origen_id',
        'bodega_destino_id',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleReporteEnvio::class, 'reporte_envio_id');
    }

    public function bodegaOrigen()
    {
        return $this->belongsTo(Bodega::class, 'bodega_origen_id');
    }

    public function bodegaDestino()
    {
        return $this->belongsTo(Bodega::class, 'bodega_destino_id');
    }
}
