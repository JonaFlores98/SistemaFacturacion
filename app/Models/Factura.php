<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'total'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
