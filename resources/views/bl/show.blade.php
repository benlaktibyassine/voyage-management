<x-head title="Détails du Bon de Livraison"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails du Bon de Livraison</h1>

                <div class="mb-4">
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">Commande ID: {{ $bonLivraison->cmd_id }}</h2>
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">Voyage ID: {{ $bonLivraison->voyage_id }}</h2>
                </div>

                <div class="mb-4">
                    @if ($bonLivraison->scaned != 1)
                        <form action="{{ route('details_bl.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="bl_id" value="{{ $bonLivraison->id }}">

                            <div class="mb-4">
                                <label for="produit_id" class="block text-sm font-medium text-gray-700">Produit</label>
                                <select name="produit_id" id="produit_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="updateMaxQuantity()">
                                    @foreach ($availableProducts as $product)
                                        <option value="{{ $product->produit_id }}"
                                            data-available="{{ $product->quantite - $product->allocated_quantity }}">
                                            {{ $product->nom }} (Disponible:
                                            {{ $product->quantite - $product->allocated_quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('produit_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                                <input type="number" name="quantity" id="quantity"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    min="1">
                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-[#494e159f] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#000000fa] focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Ajouter</button>
                            </div>

                        </form>
                    @else
                        <p class="text-lg font-bold text-[#1c5007] text-center">Le bon de livraison a
                            déjà été scanné.</p>
                    @endif
                </div>

                <h2 class="text-2xl font-bold mb-4 text-gray-800">Produits dans ce Bon de Livraison</h2>

                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Produit</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Quantité</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonLivraison->details as $detail)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 border-b text-gray-800">{{ $detail->produit->nom }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $detail->qte }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">
                                    @if ($bonLivraison->scaned != 1)
                                        <form action="{{ route('details_bl.destroy', $detail->id) }}" method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fa-solid fa-trash" style="color: #ef4444;"></i>

                                            </button>
                                        </form>
                                    @else
                                        <p class="text-gray-600">Produit déjà livré</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="text-center">
                <h1 class="text-6xl font-extrabold text-gray-900">404</h1>
                <p class="mt-4 text-xl font-semibold text-gray-700">Page Not Found</p>
                <p class="mt-2 text-gray-500">Sorry, the page you are looking for doesn't exist.</p>
                <a href="{{ url('/') }}"
                    class="mt-6 inline-block px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                    Go to Homepage
                </a>
            </div>
        </div>
    @endif

    <script>
        function updateMaxQuantity() {
            const select = document.getElementById('produit_id');
            const quantityInput = document.getElementById('quantity');
            const selectedOption = select.options[select.selectedIndex];
            const maxQuantity = selectedOption.getAttribute('data-available');
            quantityInput.setAttribute('max', maxQuantity);
            quantityInput.value = Math.min(quantityInput.value || maxQuantity, maxQuantity);
        }

        document.addEventListener('DOMContentLoaded', updateMaxQuantity);
    </script>
</body>
