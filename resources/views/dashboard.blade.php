@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1 class="font-semibold text-xl mb-4">Bienvenido al Panel Principal</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- PROVEEDORES -->
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ url('/proveedores') }}" class="text-decoration-none">
                    <div class="small-box bg-primary d-flex align-items-center px-4">
                        <i class="fa fa-users fa-3x text-white mr-4"></i>
                        <div>
                            <h4 class="text-white mb-0">Proveedores</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- INVENTARIO -->
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <a href="{{ url('/inventario') }}" class="text-decoration-none">
                    <div class="small-box bg-success d-flex align-items-center px-4">
                        <i class="fa fa-archive fa-3x text-white mr-4"></i>
                        <div>
                            <h4 class="text-white mb-0">Inventario</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- SALIR -->
            <div class="col-lg-3 col-6">
    <button onclick="confirmarLogout()" class="small-box bg-danger w-100 border-0">
    <div class="inner d-flex align-items-center">
        <i class="fas fa-sign-out-alt fa-3x text-white mr-4"></i>
        <h3 class="text-white mb-0">Salir</h3>
    </div>
</button>

</div>


        </div>
    </div>
</section>
@stop

@section('css')
<style>
.small-box {
    height: 120px;
    border-radius: 0.25rem;
}
</style>
@stop

@section('js')
<script>
function confirmarLogout() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción cerrará tu sesión',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>
@endsection

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
