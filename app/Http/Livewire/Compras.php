<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class Compras extends Component
{
    public $proveedor_id;
    public $fecha;
    public $productos = [];
    public $total = 0;

    public function mount()
    {
        $this->fecha = now()->toDateString();
    }

    public function agregarProducto()
    {
        $this->productos[] = [
            'producto_id' => '',
            'cantidad' => 1,
            'costo_unitario' => 0,
            'subtotal' => 0
        ];
    }

    public function quitarProducto($index)
    {
        unset($this->productos[$index]);
        $this->productos = array_values($this->productos);
        $this->calcularTotal();
    }

    public function calcularSubtotal($index)
    {
        $this->productos[$index]['subtotal'] =
            $this->productos[$index]['cantidad'] *
            $this->productos[$index]['costo_unitario'];

        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = collect($this->productos)->sum('subtotal');
    }

    public function guardarCompra()
    {
        $this->validate([
            'proveedor_id' => 'required',
            'fecha' => 'required',
            'productos' => 'required|array|min:1'
        ]);

        DB::transaction(function () {

            $compra = Compra::create([
                'proveedor_id' => $this->proveedor_id,
                'fecha' => $this->fecha,
                'total' => $this->total
            ]);

            foreach ($this->productos as $item) {

                CompraDetalle::create([
                    'compra_id' => $compra->compra_id,
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'costo_unitario' => $item['costo_unitario'],
                    'subtotal' => $item['subtotal']
                ]);

                // 🔥 AUMENTAR STOCK
                Producto::where('producto_id', $item['producto_id'])
                    ->increment('stock_actual', $item['cantidad']);
            }
        });

        session()->flash('message', 'Compra registrada y stock actualizado.');
        $this->reset(['proveedor_id', 'productos', 'total']);
        $this->fecha = now()->toDateString();
    }

    public function render()
    {
        return view('livewire.compras.view', [
            'proveedores' => Proveedor::all(),
            'productosDB' => Producto::orderBy('nombre')->get()
        ]);
    }
}
