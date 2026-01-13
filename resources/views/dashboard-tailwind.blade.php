<x-guest-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">
            Panel Principal
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <a href="/proveedores"
               class="block p-6 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                <h2 class="text-xl font-bold">Proveedores</h2>
                <p class="mt-2 text-sm">Gestión de proveedores</p>
            </a>

            <a href="/inventario"
               class="block p-6 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                <h2 class="text-xl font-bold">Inventario</h2>
                <p class="mt-2 text-sm">Control de productos</p>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full h-full p-6 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                    <h2 class="text-xl font-bold">Salir</h2>
                    <p class="mt-2 text-sm">Cerrar sesión</p>
                </button>
            </form>

        </div>
    </div>
</x-guest-layout>
