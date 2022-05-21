<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ModelProduct;

class Product extends Component
{

    public $products, $product, $price, $image, $description, $name;
    public $isModalOpen = 0;

    public function render(){
        $this->products = ModelProduct::all();
        return view('livewire.Product.product');
    }
    public function create(){
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover(){
        $this->isModalOpen = true;
    }
    public function closeModalPopover(){
        $this->isModalOpen = false;
    }
    private function resetCreateForm(){
        $this->name = '';
        $this->price = '';
        $this->image = '';
        $this->description = '';
    }
    public function store(){
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
    	if ($this->product != null) {
	        ModelProduct::updateOrCreate(['id' => $this->product->id], [
	            'name' => $this->name,
	            'price' => $this->price,
	            'description' => $this->description,
	        ]);
        	session()->flash('message', 'Product updated.');
    	}
    	else{
	        ModelProduct::Create([
	            'name' => $this->name,
	            'price' => $this->price,
	            'image' => '',
	            'description' => $this->description,
	        ]);
        	session()->flash('message', 'Product created.');
    	}
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id){
        $this->product = $product = ModelProduct::findOrFail($id);
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
    
        $this->openModalPopover();
    }
    public function delete($id){
        ModelProduct::find($id)->delete();
        session()->flash('message', 'Product deleted.');
    }
}
