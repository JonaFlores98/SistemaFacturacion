<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\DetalleFactura;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturaController extends Controller
{
    /**
     * Guardar una nueva factura
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('=== INICIANDO STORE FACTURA ===');
        Log::info('Datos recibidos:', $request->all());
        
        try {
            // 1. VALIDACIÓN
            $validated = $request->validate([
                'tipo_documento' => 'required|string',
                'cliente' => 'required|string',
                'fecha' => 'required|date',
                'subtotal' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'productos' => 'required|array|min:1',
                'productos.*.nombre' => 'required|string',
                'productos.*.cantidad' => 'required|integer|min:1',
                'productos.*.precio' => 'required|numeric|min:0',
            ]);
            
            Log::info('✅ Validación pasada');
            
            // 2. INICIAR TRANSACCIÓN
            DB::beginTransaction();
            
            // 3. GENERAR NÚMERO DE FACTURA
            $numeroFactura = 'FAC-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // 4. CREAR FACTURA
            $facturaData = [
                'tipo_documento' => $request->tipo_documento,
                'cliente' => $request->cliente,
                'numero_factura' => $numeroFactura,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'fecha' => $request->fecha,
            ];
            
            Log::info('📄 Creando factura:', $facturaData);
            
            $factura = Factura::create($facturaData);
            
            Log::info('✅ Factura creada. ID: ' . $factura->id . ', Número: ' . $factura->numero_factura);
            
            // 5. CREAR DETALLES
            $detallesCreados = 0;
            foreach ($request->productos as $index => $producto) {
                $detalleData = [
                    'factura_id' => $factura->id,
                    'producto' => $producto['nombre'],
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                    'total' => $producto['cantidad'] * $producto['precio'],
                ];
                
                DetalleFactura::create($detalleData);
                $detallesCreados++;
                
                Log::info("📦 Detalle {$index} creado:", $detalleData);
            }
            
            // 6. CONFIRMAR TRANSACCIÓN
            DB::commit();
            
            Log::info("🎉 FACTURA COMPLETA: {$detallesCreados} productos guardados");
            
            // 7. REDIRIGIR CON ÉXITO
            return redirect()->route('facturacion.caja')
                ->with('success', '✅ Factura #' . $factura->numero_factura . ' guardada exitosamente!');
                
        } catch (\Exception $e) {
            // 8. REVERTIR EN CASO DE ERROR
            DB::rollBack();
            
            Log::error('❌ ERROR AL GUARDAR FACTURA:', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'línea' => $e->getLine(),
                'traza' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('facturacion.caja')
                ->withInput()
                ->with('error', '❌ Error: ' . $e->getMessage());
        }
    }
}
