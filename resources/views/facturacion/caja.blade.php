@extends('adminlte::page')

@section('title', 'Caja de Facturación')

@section('content')
<div class="container-fluid">
    
    <!-- Mensajes de éxito/error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>✅ ¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>❌ Error:</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col">
            <h3>🧾 Caja de Facturación</h3>
        </div>
    </div>

    <!-- FORMULARIO DE FACTURA - CORREGIDO: usa 'facturacion.guardar' -->
    <form id="form-factura" method="POST" action="{{ route('facturacion.guardar') }}">
        @csrf
        
        <!-- Datos de factura -->
        <div class="card mb-3">
            <div class="card-body row">
                <div class="col-md-4">
                    <label><strong>Tipo de documento</strong></label>
                    <select name="tipo_documento" class="form-control" required>
                        <option value="Factura Consumidor Final" selected>Factura Consumidor Final</option>
                        <option value="Factura Crédito Fiscal">Factura Crédito Fiscal</option>
                        <option value="Comprobante de Retención">Comprobante de Retención</option>
                        <option value="Nota de Crédito">Nota de Crédito</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label><strong>Cliente</strong></label>
                    <input type="text" name="cliente" class="form-control" 
                           placeholder="Nombre del cliente" value="" required>
                </div>

                <div class="col-md-4">
                    <label><strong>Fecha</strong></label>
                    <input type="date" name="fecha" class="form-control" 
                           value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th width="120">Cantidad</th>
                            <th width="150">Precio</th>
                            <th width="150">Total</th>
                            <th width="60"></th>
                        </tr>
                    </thead>
                    <tbody id="productos">
                        <!-- Fila inicial -->
                        <tr>
                            <td>
                                <input type="text" name="productos[0][nombre]" 
                                       class="form-control producto-nombre" 
                                       placeholder="Ej: Mango" value="" required>
                            </td>
                            <td>
                                <input type="number" name="productos[0][cantidad]" 
                                       class="form-control cantidad" value="1" min="1" required>
                            </td>
                            <td>
                                <input type="number" name="productos[0][precio]" 
                                       class="form-control precio" value="0" min="0" step="0.01" required>
                            </td>
                            <td class="total-fila">$0.00</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm eliminar" disabled>✕</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="agregar" class="btn btn-primary">
                    ➕ Agregar producto
                </button>
            </div>
        </div>

        <!-- Totales -->
        <div class="card mt-3">
            <div class="card-body text-end">
                <!-- Campos ocultos para enviar totales -->
                <input type="hidden" name="subtotal" id="input-subtotal" value="0">
                <input type="hidden" name="total" id="input-total" value="0">
                
                <p class="h5">Subtotal: $<span id="subtotal">0.00</span></p>
                <h3 class="text-success">Total: $<span id="total">0.00</span></h3>
            </div>
        </div>

        <!-- Botón de guardar (DENTRO del formulario) -->
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-success btn-lg">
                💾 Guardar Factura
            </button>
            
            <!-- CORREGIDO: Si no tienes 'facturas.index', usa otra ruta -->
            <a href="{{ route('facturacion.index') }}" class="btn btn-secondary btn-lg">
                📋 Volver
            </a>
        </div>
    </form>

</div>
@endsection

@section('js')
<script>
let contadorProductos = 1;

function calcularTotales() {
    let subtotal = 0;

    document.querySelectorAll('#productos tr').forEach((row, index) => {
        const cantidad = parseFloat(row.querySelector('.cantidad')?.value || 0);
        const precio = parseFloat(row.querySelector('.precio')?.value || 0);
        const total = cantidad * precio;

        // Actualizar total de la fila
        row.querySelector('.total-fila').innerText = '$' + total.toFixed(2);
        subtotal += total;
    });

    // Actualizar totales generales
    document.getElementById('subtotal').innerText = subtotal.toFixed(2);
    document.getElementById('total').innerText = subtotal.toFixed(2);
    
    // Actualizar inputs ocultos
    document.getElementById('input-subtotal').value = subtotal.toFixed(2);
    document.getElementById('input-total').value = subtotal.toFixed(2);
}

// Calcular al cargar
document.addEventListener('DOMContentLoaded', function() {
    calcularTotales();
});

// Calcular al cambiar valores
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('cantidad') || e.target.classList.contains('precio')) {
        calcularTotales();
    }
});

// Agregar nueva fila
document.getElementById('agregar').addEventListener('click', function() {
    const nuevaFila = `
        <tr>
            <td>
                <input type="text" name="productos[${contadorProductos}][nombre]" 
                       class="form-control producto-nombre" placeholder="Producto" required>
            </td>
            <td>
                <input type="number" name="productos[${contadorProductos}][cantidad]" 
                       class="form-control cantidad" value="1" min="1" required>
            </td>
            <td>
                <input type="number" name="productos[${contadorProductos}][precio]" 
                       class="form-control precio" value="0" min="0" step="0.01" required>
            </td>
            <td class="total-fila">$0.00</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm eliminar">✕</button>
            </td>
        </tr>
    `;
    
    document.getElementById('productos').insertAdjacentHTML('beforeend', nuevaFila);
    contadorProductos++;
});

// Eliminar fila
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('eliminar')) {
        const filas = document.querySelectorAll('#productos tr');
        if (filas.length > 1) {
            e.target.closest('tr').remove();
            recalcularIndices(); // Recalcular índices después de eliminar
            calcularTotales();
        }
    }
});

// Recalcular índices de los productos después de eliminar fila
function recalcularIndices() {
    const filas = document.querySelectorAll('#productos tr');
    contadorProductos = 0;
    
    filas.forEach((fila, index) => {
        // Actualizar los name de los inputs
        const inputs = fila.querySelectorAll('input');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name && name.includes('productos[')) {
                // Reemplazar el índice
                const newName = name.replace(/productos\[\d+\]/, `productos[${index}]`);
                input.setAttribute('name', newName);
            }
        });
        contadorProductos++;
    });
}

// Validar formulario antes de enviar
document.getElementById('form-factura').addEventListener('submit', function(e) {
    const filas = document.querySelectorAll('#productos tr');
    
    if (filas.length === 0) {
        e.preventDefault();
        alert('❌ Debes agregar al menos un producto');
        return false;
    }
    
    // Verificar que todos los productos tengan nombre
    let valido = true;
    filas.forEach(row => {
        const nombreInput = row.querySelector('.producto-nombre');
        if (!nombreInput.value.trim()) {
            nombreInput.focus();
            valido = false;
        }
    });
    
    if (!valido) {
        e.preventDefault();
        alert('❌ Todos los productos deben tener un nombre');
        return false;
    }
    
    // Mostrar mensaje de carga
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '⏳ Guardando...';
    submitBtn.disabled = true;
    
    // Restaurar después de 5 segundos (por si hay error)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});
</script>
@endsection