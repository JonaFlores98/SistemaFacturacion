<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\FacturaController;

// Rutas públicas
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::get('/salir', function () {
    return view('admin.salir');
});

// Rutas de PDF
Route::get('/descargarpdf', [PDFController::class, 'generatePDF'])->name('generatePDF');
Route::get('/getinventario', [PDFController::class, 'getInventario'])->name('getinventario');

// Rutas con autenticación
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard-tailwind');
    })->name('dashboard');
    
    // Facturación
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
    Route::get('/facturacion/caja', function () {
        return view('facturacion.caja');
    })->name('facturacion.caja');
    
    // IMPORTANTE: Guardar factura - POST
    Route::post('/facturacion/guardar', [FacturaController::class, 'store'])
        ->name('facturacion.guardar');
        
    // Livewire
    Route::view('inventario', 'livewire.inventarios.index');
    Route::view('proveedores', 'livewire.proveedores.index');
});

// Sanctum (si lo usas)
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard-sanctum', function () {
    return view('dashboard');
})->name('dashboard.sanctum');