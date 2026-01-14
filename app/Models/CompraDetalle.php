<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    protected $table = 'compra_detalles';
    protected $primaryKey = 'compra_detalle_id';

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'costo_unitario',
        'subtotal'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
