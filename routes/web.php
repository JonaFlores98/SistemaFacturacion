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

// Rutas con autenticación (JETSTREAM)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard de Jetstream (DEJA ESTA SOLA)
    Route::get('/dashboard', function () {
        return view('dashboard'); // Esto carga vendor/jetstream/dashboard.blade.php
    })->name('dashboard');
    
    // Tus otras rutas
    Route::get('/facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');
    Route::get('/facturacion/caja', function () {
        return view('facturacion.caja');
    })->name('facturacion.caja');
    
    Route::post('/facturacion/guardar', [FacturaController::class, 'store'])
        ->name('facturacion.guardar');
        
    // Livewire
    Route::view('inventario', 'livewire.inventarios.index')->name('inventario');
    Route::view('proveedores', 'livewire.proveedores.index')->name('proveedores');
});

// Elimina la línea 48-50 (la otra ruta /dashboard-sanctum)