<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey = 'proveedor_id';

    protected $fillable = [
        'nombre',
        'nit',
        'nrc',
        'nombre_comercial',
        'telefono',
        'correo',
        'direccion',
        'tipo_proveedor',
    ];
}
