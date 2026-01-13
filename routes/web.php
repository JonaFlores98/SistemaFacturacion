<?php

use App\Http\Controllers\PDFController;
use App\Http\Livewire\Inventarios;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\PDF;



Route::view('inventario', 'livewire.inventarios.index')->middleware('auth');
Route::view('proveedores', 'livewire.proveedores.index')->middleware('auth');


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::get('/descargarpdf', [App\Http\Controllers\PDFController::class], 'generatePDF')->name('generatePDF');
Route::get('/getinventario', [App\Http\Controllers\PDFController::class], 'getInventario')->name('getinventario');

Route::get('/facturacion', function () {
    return view('facturacion.index');
})->name('facturacion');


Route::get('/salir', function () {
    return view('admin.salir');
});

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard-tailwind');
})->name('dashboard');







Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

use App\Http\Controllers\FacturacionController;

Route::middleware(['auth'])->group(function () {
    Route::get('/facturacion', [FacturacionController::class, 'index'])
        ->name('facturacion.index');
});
Route::middleware(['auth'])->get('/facturacion/caja', function () {
    return view('facturacion.caja');
})->name('facturacion.caja');