<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search;
    public $formVisible = false;
    public $formUpdate = false;
    public $selectedProduct;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'formClose' => 'formCloseHandler',
        'productStored' => 'productStoredHandler',
        'productUpdated' => 'productUpdatedHandler'
    ];

    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search === null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate),
        ]);
    }

    public function formCloseHandler()
    {
        $this->formVisible = false;
    }

    public function productStoredHandler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Product created successfully!');
    }

    public function updateProduct($productId)
    {
        $this->formVisible = true;
        $this->formUpdate = true;

        $product = Product::find($productId);

        $this->emit('updateProduct', $product);
    }

    public function productUpdatedHandler()
    {
        $this->formVisible = false;
        $this->formUpdate = false;
        session()->flash('message', 'Product updated successfully!');
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        $this->selectedProduct = $product;
    }

    public function destroy()
    {
        if ($this->selectedProduct->image) {
            Storage::disk('public')->delete($this->selectedProduct->image);
        }

        $this->selectedProduct->delete();
        
        session()->flash('message', 'Product deleted successfully!');
        $this->redirect(request()->header('referer'));
    }
}
