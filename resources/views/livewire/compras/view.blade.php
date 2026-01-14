<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Nueva Compra</h4>
        </div>

        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-group">
                <label>Proveedor</label>
                <select wire:model="proveedor_id" class="form-control">
                    <option value="">Seleccione</option>
                    @foreach ($proveedores as $prov)
                        <option value="{{ $prov->proveedor_id }}">
                            {{ $prov->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Fecha</label>
                <input type="date" wire:model="fecha" class="form-control">
            </div>

            <hr>

            <button class="btn btn-primary mb-2" wire:click="agregarProducto">
                + Agregar Producto
            </button>

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $i => $item)
                        <tr>
                            <td>
                                <select wire:model="productos.{{ $i }}.producto_id"
                                        class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($productosDB as $p)
                                        <option value="{{ $p->producto_id }}">
                                            {{ $p->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" min="1"
                                       wire:model="productos.{{ $i }}.cantidad"
                                       wire:change="calcularSubtotal({{ $i }})"
                                       class="form-control">
                            </td>

                            <td>
                                <input type="number" min="0"
                                       wire:model="productos.{{ $i }}.costo_unitario"
                                       wire:change="calcularSubtotal({{ $i }})"
                                       class="form-control">
                            </td>

                            <td>${{ $item['subtotal'] }}</td>

                            <td>
                                <button class="btn btn-danger btn-sm"
                                        wire:click="quitarProducto({{ $i }})">
                                    X
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total: ${{ $total }}</h4>

            <button class="btn btn-success" wire:click="guardarCompra">
                Guardar Compra
            </button>
        </div>
    </div>
</div>
