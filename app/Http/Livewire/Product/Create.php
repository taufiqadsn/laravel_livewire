<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $image;

    public function render()
    {
        return view('livewire.product.create');
    }

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image|max:1048576'
    ];

    public function store()
    {
        $imageName = '';

        $this->validate();
        $product = [
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $imageName
        ];


        if ($this->image) {
            $imageName = \Str::slug($this->title) . '-' . uniqid() . '.' . $this->image->getClientOriginalExtension();

            $this->image->storeAs('public', $imageName, 'local');
        }

        Product::create($product);

        $this->emit('productStored');
    }
}
