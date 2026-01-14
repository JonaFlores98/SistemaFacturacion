@section('title', 'Inventario')

<div class="container-fluid">
    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h4>Inventario</h4>

            <input type="text" wire:model="keyWord" class="form-control w-25"
                   placeholder="Buscar producto...">
        </div>

        <div class="card-body table-responsive">

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>Stock</th>
                        <th width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->codigo_barra }}</td>
                            <td>${{ $producto->precio_unitario }}</td>
                            <td>${{ $producto->costo_unitario }}</td>
                            <td>
                                <span class="{{ $producto->stock_actual <= 5 ? 'text-danger font-weight-bold' : '' }}">
                                    {{ $producto->stock_actual }}
                                </span>
                            </td>
                            <td>
                                <button wire:click="edit({{ $producto->producto_id }})"
                                        class="btn btn-sm btn-info">
                                    Editar
                                </button>

                                <button wire:click="$set('selected_id', {{ $producto->producto_id }})"
                                        data-toggle="modal" data-target="#ajusteStockModal"
                                        class="btn btn-sm btn-warning">
                                    Ajustar Stock
                                </button>

                                <button wire:click="destroy({{ $producto->producto_id }})"
                                        class="btn btn-sm btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $productos->links() }}
        </div>
    </div>
</div>

{{-- MODAL AJUSTE STOCK --}}
<div wire:ignore.self class="modal fade" id="ajusteStockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Ajustar Stock</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <select wire:model="tipo_ajuste" class="form-control mb-2">
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                </select>

                <input type="number" wire:model="cantidad_ajuste"
                       class="form-control" placeholder="Cantidad">

                @error('cantidad_ajuste')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-footer">
                <button wire:click="ajustarStock"
                        class="btn btn-primary">
                    Aplicar
                </button>
            </div>
        </div>
    </div>
</div>
