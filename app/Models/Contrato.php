<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $fillable = [
        'cliente_id',
        'producto_id',
        'cantidad',
        'fecha_contrato',
        'total_costo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
