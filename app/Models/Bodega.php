<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bodega extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'ubicación',
        'responsable_id',
    ];

    /**
     * Relación con el inventario.
     */
    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }

    /**
     * Relación con el responsable (usuario).
     */
    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
