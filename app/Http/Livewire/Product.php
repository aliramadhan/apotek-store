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
    
        Student::updateOrCreate(['id' => $this->product->id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);
        session()->flash('message', $this->product->id ? 'Student updated.' : 'Student created.');
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
        Student::find($id)->delete();
        session()->flash('message', 'Studen deleted.');
    }
}
