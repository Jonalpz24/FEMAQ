<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';
    protected $fillable = ['bodega_id', 'producto_id', 'cantidad'];

    public function bodega()
    {
        return $this->belongsTo(Bodega::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
