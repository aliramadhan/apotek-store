<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ListSupplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Supplier extends Component
{
    use LivewireAlert;
	public $suppliers, $setSupplier, $name, $cp, $phone, $address;
    public $isModalOpen = 0;
    
    public function render(){
        $this->suppliers = ListSupplier::all();
        return view('livewire.Supplier.supplier');
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
        $this->setSupplier = '';
        $this->name = '';
        $this->cp = '';
        $this->phone = '';
        $this->address = '';
    }
    public function store(){
        $this->validate([
            'name' => 'required',
            'cp' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
    	if ($this->setSupplier != null) {
	        ListSupplier::updateOrCreate(['id' => $this->setSupplier->id], [
	            'name' => $this->name,
	            'contact_person' => $this->cp,
	            'number_phone' => $this->phone,
	            'address' => $this->address,
	        ]);
            $this->alert('success', 'Supplier updated.', [
                'position' =>  'center', 
                'timer' =>  3000,
                'toast' =>  false, 
                'text' =>  '', 
            ]);
    	}
    	else{
	        ListSupplier::Create([
	            'name' => $this->name,
	            'contact_person' => $this->cp,
	            'number_phone' => $this->phone,
	            'address' => $this->address,
	        ]);
            $this->alert('success', 'Supplier added.', [
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
        $this->setSupplier = $supplier = ListSupplier::findOrFail($id);
        $this->name = $supplier->name;
        $this->cp = $supplier->contact_person;
        $this->phone = $supplier->number_phone;
        $this->address = $supplier->address;

        $this->openModalPopover();
    }
    public function delete($id){
        ListSupplier::find($id)->delete();
        $this->alert('success', 'Supplier deleted.', [
            'position' =>  'center', 
            'timer' =>  3000,
            'toast' =>  false, 
            'text' =>  '', 
        ]);
    }
}
