<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

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

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image|max:1048576'
    ];

    public function render()
    {
        return view('livewire.product.update');
    }

    public function updateProductHandler ($product)
    {
        $this->productId = $product['id'];
        $this->title = $product['title'];
        $this->description = $product['description'];
        $this->price = $product['price'];
        $this->imageOld = asset('/storage/' . $product['image']);
    }

    public function update ()
    {
        $this->validate();

        $imageName = '';

        if ($this->productId) {
            $product = Product::find($this->productId);

            if ($this->image) {
                Storage::disk('public')->delete($product->image);

                $imageName = Str::slug($this->title) . '-' . uniqid() . '.' . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public', $imageName, 'local');
            } else {
                $this->image = $product->image;
            }

            $product->update([
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'image' => $imageName
            ]);

            $this->emit('productUpdated');
        }
    }
}
