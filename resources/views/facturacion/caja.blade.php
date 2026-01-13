@extends('adminlte::page')

@section('title', 'Caja - Facturación')

@section('content_header')
    <h1>Caja de Facturación</h1>
@stop

@section('content')
<div class="row">

    <!-- TIPO DE DOCUMENTO -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Tipo de factura
            </div>
            <div class="card-body">
                <select class="form-control">
                    <option>Consumidor Final</option>
                    <option>Crédito Fiscal</option>
                    <option>Factura Exportación</option>
                    <option>Sujeto Excluido</option>
                </select>
            </div>
        </div>
    </div>

    <!-- CLIENTE -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Cliente
            </div>
            <div class="card-body">
                <input type="text" class="form-control" placeholder="Nombre del cliente">
            </div>
        </div>
    </div>

    <!-- CORRELATIVO -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Nº Factura
            </div>
            <div class="card-body">
                <input type="text" class="form-control" value="0000001" readonly>
            </div>
        </div>
    </div>

</div>

<!-- PRODUCTOS -->
<div class="card mt-3">
    <div class="card-header">
        Productos
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Producto</th>
                    <th width="100">Cantidad</th>
                    <th width="120">Precio</th>
                    <th width="120">Total</th>
                    <th width="60"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input class="form-control"></td>
                    <td><input type="number" class="form-control" value="1"></td>
                    <td><input type="number" class="form-control" value="0.00"></td>
                    <td>$0.00</td>
                    <td>
                        <button class="btn btn-danger btn-sm">✕</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- TOTALES -->
<div class="row mt-3">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p>Subtotal: $0.00</p>
                <p>IVA (13%): $0.00</p>
                <h4>Total: $0.00</h4>
            </div>
        </div>
    </div>
</div>

<!-- ACCIONES -->
<div class="text-right mt-3">
    <button class="btn btn-success btn-lg">
        <i class="fas fa-save"></i> Facturar
    </button>
</div>
@stop