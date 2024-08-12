<x-head title="Détails de la Commande"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails de la Commande</h1>

                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Description</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                Devis</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                État</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $commande->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                {{ $commande->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                {{ $commande->devis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <span
                                    class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
                                {{ $commande->etat == 'en cours'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($commande->etat == 'livré'
                                        ? 'bg-green-100 text-green-800'
                                        : ($commande->etat == 'annulé'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800')) }}">
                                    {{ $commande->etat }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-end">
                    @if ($commande->etat != 'livré' && $commande->etat != 'annulé')
                        <a href="{{ route('bon_livraisons.create', ['commande_id' => $commande->id]) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Créer Bon de Livraison
                        </a>
                    @endif

                    <a href="{{ route('bon_livraisons.index', ['commande_id' => $commande->id]) }}"
                        class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                        Voir Bons de Livraison
                    </a>
                </div>

                <hr class="my-6" />

                <h2 class="text-xl font-bold mt-6 mb-4 text-gray-800">Produits</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($commande->detailsCommandes as $detail)
                        <div class="relative bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden">
                            <img src="data:image/jpeg;base64,{{ base64_encode($detail->produit->image) }}"
                                alt="{{ $detail->produit->nom }}" class="w-full h-40 object-cover">
                            <div
                                class="absolute top-2 right-2 bg-green-600 text-white text-xs font-bold rounded-full px-2 py-1">
                                {{ $detail->quantite }}
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $detail->produit->nom }}</h3>
                                <p class="text-gray-600">{{ $detail->produit->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</body>
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

</html>
