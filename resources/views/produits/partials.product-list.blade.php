@if ($produits->isEmpty())
    <p class="text-center text-gray-600">Produit n'existe pas</p>
@else
    @foreach ($produits as $product)
        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
            <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" alt="{{ $product->nom }}"
                class="w-full h-48 object-cover">
            <div class="p-4 flex-1 flex flex-col">
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->nom }}</h2>
                <p class="text-gray-600 mt-2 mb-auto">{{ $product->prix }} €</p>
                <div class="flex justify-end space-x-2 mt-4">
                    <a href="{{ route('produits.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fa-solid fa-pen-to-square" style="color: #3b82f6;"></i>
                    </a>
                    <button type="button" class="text-red-500 hover:text-red-700"
                        onclick="openConfirmModal({{ $product->id }})">
                        <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endif
