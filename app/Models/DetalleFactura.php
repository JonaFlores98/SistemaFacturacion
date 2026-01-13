<?php

namespace App\Models; // ← DEBE decir esto

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $fillable = [
        'factura_id',
        'producto',
        'cantidad',
        'precio',
        'total'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
}