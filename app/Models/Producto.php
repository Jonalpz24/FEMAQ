<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'descripción',
        'unidad_medida',
        'precio_unitario', 
        'imagen_url',
    ];
    public function contratos()
{
    return $this->hasMany(Contrato::class);
}

}
