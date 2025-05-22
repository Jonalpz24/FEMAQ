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
        'precio_unitario', // Asegúrate de que este nombre coincida con la columna en la base de datos
    ];
}
