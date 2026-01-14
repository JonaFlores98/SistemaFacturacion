<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class Inventarios extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $keyWord;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';

        return view('livewire.inventarios.view', [
            'productos' => Producto::where('nombre', 'LIKE', $keyWord)
                ->orWhere('codigo_barra', 'LIKE', $keyWord)
                ->paginate(10)
        ]);
    }
}
