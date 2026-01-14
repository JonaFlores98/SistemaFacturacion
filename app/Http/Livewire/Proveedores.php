<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedor;

class Proveedores extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selected_id;
    public $keyWord = '';

    public $nombre;
    public $nit;
    public $nrc;
    public $nombre_comercial;
    public $telefono;
    public $correo;
    public $direccion;
    public $tipo_proveedor;

    public $updateMode = false;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return view('livewire.proveedores.view', [
            'proveedores' => Proveedor::where(function ($query) use ($keyWord) {
                    $query->where('nombre', 'LIKE', $keyWord)
                          ->orWhere('nit', 'LIKE', $keyWord)
                          ->orWhere('nrc', 'LIKE', $keyWord)
                          ->orWhere('nombre_comercial', 'LIKE', $keyWord)
                          ->orWhere('telefono', 'LIKE', $keyWord)
                          ->orWhere('correo', 'LIKE', $keyWord)
                          ->orWhere('direccion', 'LIKE', $keyWord)
                          ->orWhere('tipo_proveedor', 'LIKE', $keyWord);
                })
                ->latest()
                ->paginate(10),
        ]);
    }

    private function resetInput()
    {
        $this->nombre = null;
        $this->nit = null;
        $this->nrc = null;
        $this->nombre_comercial = null;
        $this->telefono = null;
        $this->correo = null;
        $this->direccion = null;
        $this->tipo_proveedor = null;
        $this->selected_id = null;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'nit' => 'required',
            'nrc' => 'required',
            'nombre_comercial' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'tipo_proveedor' => 'required',
        ]);

        Proveedor::create([
            'nombre' => $this->nombre,
            'nit' => $this->nit,
            'nrc' => $this->nrc,
            'nombre_comercial' => $this->nombre_comercial,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'tipo_proveedor' => $this->tipo_proveedor,
        ]);

        $this->resetInput();
        session()->flash('message', 'Proveedor agregado correctamente.');
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $this->selected_id = $proveedor->proveedor_id;
        $this->nombre = $proveedor->nombre;
        $this->nit = $proveedor->nit;
        $this->nrc = $proveedor->nrc;
        $this->nombre_comercial = $proveedor->nombre_comercial;
        $this->telefono = $proveedor->telefono;
        $this->correo = $proveedor->correo;
        $this->direccion = $proveedor->direccion;
        $this->tipo_proveedor = $proveedor->tipo_proveedor;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'nit' => 'required',
            'nrc' => 'required',
            'nombre_comercial' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required',
            'tipo_proveedor' => 'required',
        ]);

        if ($this->selected_id) {
            $proveedor = Proveedor::find($this->selected_id);

            $proveedor->update([
                'nombre' => $this->nombre,
                'nit' => $this->nit,
                'nrc' => $this->nrc,
                'nombre_comercial' => $this->nombre_comercial,
                'telefono' => $this->telefono,
                'correo' => $this->correo,
                'direccion' => $this->direccion,
                'tipo_proveedor' => $this->tipo_proveedor,
            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Proveedor actualizado correctamente.');
        }
    }

    public function destroy($id)
    {
        Proveedor::find($id)->delete();
        session()->flash('message', 'Proveedor eliminado correctamente.');
    }
}
