<div>
    <div class="py-12">
	    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
	            <button wire:click="create()"
	                class="bg-transparent mb-4 hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
	                Create Suppplier
	            </button>
	            @if($isModalOpen)
	            @include('livewire.Supplier.create')
	            @endif
	            <table class="table-fixed w-full">
	                <thead>
	                    <tr class="bg-gray-100">
	                        <th class="px-4 py-2 w-20">No.</th>
	                        <th class="px-4 py-2">Name</th>
	                        <th class="px-4 py-2">Contact Person</th>
	                        <th class="px-4 py-2">Number Phone</th>
	                        <th class="px-4 py-2">Address</th>
	                        <th class="px-4 py-2">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    @foreach($suppliers as $supplier)
	                    <tr>
	                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
	                        <td class="border px-4 py-2">{{ $supplier->name }}</td>
	                        <td class="border px-4 py-2">{{ $supplier->contact_person}}</td>
	                        <td class="border px-4 py-2">{{ $supplier->number_phone}}</td>
	                        <td class="border px-4 py-2">{{ $supplier->address}}</td>
	                        <td class="border px-4 py-2">
	                            <button wire:click="edit({{ $supplier->id }})"
	                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full">Edit</button>
	                            <button onclick="confirm('Hapus supplier {!! $supplier->name !!}?') || event.stopImmediatePropagation()" wire:click="delete({{ $supplier->id }})"
	                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Delete</button>
	                        </td>
	                    </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
