@section('title', 'Inventario')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Inventario</h4>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->codigo_barra }}</td>
                            <td>${{ $producto->precio_unitario }}</td>
                            <td>${{ $producto->costo_unitario }}</td>
                            <td>{{ $producto->stock_actual }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $productos->links() }}
        </div>
    </div>
</div>
