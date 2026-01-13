@extends('adminlte::page')

@section('title', 'Facturación')

@section('content_header')
    <h1>Facturación</h1>
@stop

@section('content')
<div class="row">

    <!-- APLICACIONES -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <strong>Aplicaciones</strong>
            </div>

            <div class="card-body">
                <div class="row">

                    <!-- FACTURACIÓN -->
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('facturacion.caja') }}" class="app-box bg-success">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Facturación</span>
                        </a>
                    </div>

                    <!-- DEVOLUCIÓN -->
                    <div class="col-md-4 mb-4">
                        <a href="#" class="app-box bg-danger">
                            <i class="fas fa-undo"></i>
                            <span>Devolución</span>
                        </a>
                    </div>

                    <!-- PAGO CRÉDITOS -->
                    <div class="col-md-4 mb-4">
                        <a href="#" class="app-box bg-warning">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Pago de créditos</span>
                        </a>
                    </div>

                    <!-- CORTES -->
                    <div class="col-md-4 mb-4">
                        <a href="#" class="app-box bg-info">
                            <i class="fas fa-list"></i>
                            <span>Cortes</span>
                        </a>
                    </div>

                    <!-- CAJA CHICA -->
                    <div class="col-md-4 mb-4">
                        <a href="#" class="app-box bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Caja Chica</span>
                        </a>
                    </div>

                    <!-- SUJETO EXCLUIDO -->
                    <div class="col-md-4 mb-4">
                        <div class="app-box disabled">
                            <i class="fas fa-ban"></i>
                            <span>Sujeto Excluido</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- INFORMACIÓN DE LA CAJA -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Información de la caja</strong>
            </div>

            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong> Este equipo no es una caja</strong>
                    <p class="mt-2 mb-0">
                        Las aplicaciones relacionadas con facturación de productos únicamente
                        están disponibles en equipos que han sido registrados como cajas.
                        <br><br>
                        Para agregar una nueva caja vaya al menú
                        <strong>Administración → Facturación → Nueva caja</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('css')
<style>
.app-box {
    height: 140px;
    border-radius: 6px;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}

.app-box i {
    font-size: 40px;
    margin-bottom: 10px;
}

.app-box:hover {
    transform: scale(1.05);
    color: #fff;
}

.app-box.disabled {
    background: #f4f4f4;
    color: #999;
    cursor: not-allowed;
}

.app-box.disabled i {
    color: #999;
}
</style>
@stop
