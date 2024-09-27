<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $image;
    public $productId;
    public $imageOld;

    protected $listeners = [
        'updateProduct' => 'updateProductHandler'
    ];

    public function render()
    {
        return view('livewire.product.update');
    }

    public function updateProductHandler ($product)
    {
        // $this->title = $product['title'];
        // $this->description = $product['description'];
        // $this->price = $product['price'];
        // $this->imageOld = asset('public/storage/' . $product['image']);
        dd(asset('public/storage/') . '/' . $product['image']);
    }
}
