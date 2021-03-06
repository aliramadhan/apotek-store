<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as ModelProduct;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Product extends Component
{
    use LivewireAlert;
    public $products, $setProduct, $price, $image, $description, $name;
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
        $this->setProduct = '';
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
    	if ($this->setProduct != null) {
	        ModelProduct::updateOrCreate(['id' => $this->setProduct->id], [
	            'name' => $this->name,
	            'price' => $this->price,
	            'description' => $this->description,
	        ]);
            $this->alert('success', 'Product updated.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
    	}
    	else{
	        ModelProduct::Create([
	            'name' => $this->name,
	            'price' => $this->price,
	            'image' => '',
	            'description' => $this->description,
	        ]);
            $this->alert('success', 'Product created.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
    	}
        $this->closeModalPopover();
        $this->resetCreateForm();
    }
    public function edit($id){
        $this->setProduct = $product = ModelProduct::findOrFail($id);
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
    
        $this->openModalPopover();
    }
    public function delete($id){
        ModelProduct::find($id)->delete();
        $this->alert('success', 'Product deleted.', [
            'position' =>  'center', 
            'timer' =>  3000,
            'toast' =>  false, 
            'text' =>  '', 
        ]);
    }
}
