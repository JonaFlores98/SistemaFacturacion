<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cajacontroller extends Controller
{
    public function store(Request $request): Response
    {
        // Aquí deberías crear o procesar la factura primero
        // y obtener su ID, por ejemplo:
        $factura = Factura::create([ /* datos de la factura */ ]);
        
        // Llamar a pdfDTE con el ID de la factura creada
        return $this->pdfDTE($factura->id);
    }

    public function pdfDTE($id): Response
    {
        $factura = Factura::with('detalles')->findOrFail($id);
        
        $pdf = Pdf::loadView(
            'pdf.dte', 
            compact('factura')
        )->setPaper('letter', 'portrait');

        return $pdf->stream('factura_' . $factura->numero_factura . '.pdf');
    }
}