<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $products = Product::where('name', 'like', $searchTerm)->get();

        return view('livewire.product-search', ['products' => $products]);
    }
}
