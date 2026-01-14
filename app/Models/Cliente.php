<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email'
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}
