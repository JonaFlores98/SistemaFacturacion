<?php

namespace App\Models; // ← Agrega esta línea

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'tipo_documento',
        'cliente',
        'numero_factura',
        'subtotal',
        'total'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}