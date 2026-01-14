<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class Inventarios extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $keyWord = '';

    // Producto
    public $selected_id;
    public $nombre;
    public $descripcion;
    public $codigo_barra;
    public $precio_unitario;
    public $costo_unitario;
    public $stock_actual;
    public $categoria_id;

    // Ajuste stock
    public $cantidad_ajuste;
    public $tipo_ajuste = 'entrada'; // entrada | salida

    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return view('livewire.inventarios.view', [
            'productos' => Producto::where('nombre', 'LIKE', $keyWord)
                ->orWhere('codigo_barra', 'LIKE', $keyWord)
                ->orderBy('nombre')
                ->paginate(10)
        ]);
    }

    /* ===============================
       CRUD PRODUCTOS
    =============================== */

    public function resetInput()
    {
        $this->reset([
            'selected_id',
            'nombre',
            'descripcion',
            'codigo_barra',
            'precio_unitario',
            'costo_unitario',
            'categoria_id',
            'cantidad_ajuste',
            'tipo_ajuste'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'codigo_barra' => 'required',
            'precio_unitario' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
            'categoria_id' => 'required'
        ]);

        Producto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'codigo_barra' => $this->codigo_barra,
            'precio_unitario' => $this->precio_unitario,
            'costo_unitario' => $this->costo_unitario,
            'stock_actual' => 0,
            'categoria_id' => $this->categoria_id
        ]);

        $this->resetInput();
        session()->flash('message', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        $this->selected_id = $producto->producto_id;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->codigo_barra = $producto->codigo_barra;
        $this->precio_unitario = $producto->precio_unitario;
        $this->costo_unitario = $producto->costo_unitario;
        $this->categoria_id = $producto->categoria_id;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'codigo_barra' => 'required',
            'precio_unitario' => 'required|numeric',
            'costo_unitario' => 'required|numeric',
            'categoria_id' => 'required'
        ]);

        Producto::find($this->selected_id)->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'codigo_barra' => $this->codigo_barra,
            'precio_unitario' => $this->precio_unitario,
            'costo_unitario' => $this->costo_unitario,
            'categoria_id' => $this->categoria_id
        ]);

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('message', 'Producto actualizado.');
    }

    public function destroy($id)
    {
        Producto::find($id)->delete();
        session()->flash('message', 'Producto eliminado.');
    }

    /* ===============================
       AJUSTE DE STOCK (CLAVE)
    =============================== */

    public function ajustarStock()
    {
        $this->validate([
            'cantidad_ajuste' => 'required|integer|min:1',
            'tipo_ajuste' => 'required'
        ]);

        $producto = Producto::findOrFail($this->selected_id);

        if ($this->tipo_ajuste === 'salida') {
            if ($producto->stock_actual < $this->cantidad_ajuste) {
                $this->addError('cantidad_ajuste', 'No hay stock suficiente.');
                return;
            }
            $producto->stock_actual -= $this->cantidad_ajuste;
        } else {
            $producto->stock_actual += $this->cantidad_ajuste;
        }

        $producto->save();

        $this->reset(['cantidad_ajuste', 'tipo_ajuste']);
        session()->flash('message', 'Stock actualizado correctamente.');
    }
}
