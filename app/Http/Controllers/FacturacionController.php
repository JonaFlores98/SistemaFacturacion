<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    public function index()
    {
        return view('facturacion.facturacion');
    }
}
