<x-head title="Mettre à jour un Bon de livraison"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Mettre à jour un Bon de livraison</h1>

                <form action="{{ route('bon_livraisons.update', $bonLivraison->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="voyage_id" class="block text-sm font-medium text-gray-700">Numéro de Voyage</label>
                        <select name="voyage_id" id="voyage_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($voyages as $voyage)
                                <option value="{{ $voyage->mat }}"
                                    {{ $voyage->mat == request()->voyage_id ? 'selected' : '' }}>{{ $voyage->mat }}
                                </option>
                            @endforeach
                        </select>
                        @error('voyage_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="commande_id" class="block text-sm font-medium text-gray-700">Numéro de
                            Commande</label>
                        <select name="commande_id" id="commande_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($commandes as $commande)
                                <option value="{{ $commande->id }}"
                                    {{ $commande->id == request()->commande_id ? 'selected' : '' }}>{{ $commande->id }}
                                </option>
                            @endforeach
                        </select>
                        @error('commande_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Ajouter</button>
                    </div>
                </form>
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
</body>
