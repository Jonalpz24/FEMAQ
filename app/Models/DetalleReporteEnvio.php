<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleReporteEnvio extends Model
{
    use HasFactory;

    protected $table = 'detalle_reporte_envio';

    protected $fillable = [
        'reporte_envio_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    // Método para establecer un valor predeterminado si es nulo
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($detalle) {
            if (is_null($detalle->precio_unitario)) {
                $detalle->precio_unitario = 0; // Valor predeterminado
            }
        });
    }

    public function reporteEnvio()
    {
        return $this->belongsTo(ReporteEnvio::class, 'reporte_envio_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Método para calcular el subtotal dinámicamente
    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio_unitario;
    }
}
