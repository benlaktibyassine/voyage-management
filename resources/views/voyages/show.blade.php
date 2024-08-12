<x-head title="Détails du Voyage"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails du Voyage</h1>

                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">Voyage ID: {{ $voyage->mat }}</h2>
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <h3 class="text-xl font-semibold text-gray-700">Chauffeur:</h3>
                            <p class="text-lg text-gray-600">{{ $voyage->chauffeur->nom }}
                                {{ $voyage->chauffeur->prenom }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            @if ($voyage->chauffeur->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($voyage->chauffeur->image) }}"
                                    alt="Image du Chauffeur"
                                    class="w-24 h-24 object-cover rounded-full border border-gray-300">
                            @else
                                <div
                                    class="w-24 h-24 bg-gray-200 rounded-full border border-gray-300 flex items-center justify-center">
                                    <p class="text-gray-500">No Image</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold mb-2 text-gray-800">Camion Matricule:</h2>
                    <p class="text-lg text-gray-600 mb-4">{{ $voyage->camion->matricule }}</p>

                    <h2 class="text-2xl font-bold mb-2 text-gray-800">QR Code:</h2>
                    <img src="data:image/svg+xml;base64,{{ $voyage->codeqr }}" alt="QR Code"
                        class="w-32 h-32 object-contain border border-gray-300 rounded-lg shadow-md">

                    <!-- Add Bon de Livraison Button -->
                    @if (is_null($voyage->scanS_date))
                        <div class="mt-4 text-center">
                            <a href="{{ route('bon_livraisons.create', ['voyage_id' => $voyage->mat]) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-gray-300 active:bg-green-700 disabled:opacity-25 transition ease-in-out duration-150">
                                Ajouter un Bon de Livraison
                            </a>
                        </div>
                    @endif

                </div>

                <h2 class="text-2xl font-bold mb-4 text-gray-800">Bon de Livraison</h2>

                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">ID</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Commande ID</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Nombre de scan Sorite
                            </th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Nombre de scan Entrée
                            </th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonLivraisons as $bl)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 border-b text-gray-800">{{ $bl->id }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $bl->cmd_id }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $bl->nbr_scanS }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $bl->nbr_scanE }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">
                                    <a href="{{ route('bon_livraisons.show', $bl->id) }}"
                                        class="text-blue-600 hover:text-blue-800 underline">
                                        Voir Détails
                                    </a>
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

</body>
