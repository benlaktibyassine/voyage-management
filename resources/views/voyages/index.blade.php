<x-head title="Voyages"></x-head>

<body class="bg-[#e2e0e0a2]">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Voyages</h1>

            <!-- Search Form -->
            <div class="mb-4">
                <form method="GET" action="{{ route('voyages.index') }}" class="mb-4 grid grid-cols-6 gap-4">
                    <input type="text" name="search_mat" value="{{ request()->query('search_mat') }}" placeholder="Search Maticule" class="p-2 border border-gray-400 rounded-md">

                    <input type="date" name="search_scanS_date" value="{{ request()->query('search_scanS_date') }}" placeholder="Scan S Date" class="p-2 border border-gray-400 rounded-md">

                    <input type="date" name="search_scanE_date" value="{{ request()->query('search_scanE_date') }}" placeholder="Scan E Date" class="p-2 border border-gray-400 rounded-md">

                    <input type="text" name="search_chauffeur_id" value="{{ request()->query('search_chauffeur_id') }}" placeholder="Chauffeur ID" class="p-2 border border-gray-400 rounded-md">

                    <input type="text" name="search_camion_id" value="{{ request()->query('search_camion_id') }}" placeholder="Camion ID" class="p-2 border border-gray-400 rounded-md">

                    <button type="submit" class="px-4 py-2 bg-[#30282077] text-white rounded-md">Search</button>
                </form>

            </div>

            <!-- Ajouter Voyage Button -->
            <div class="mb-4">
                <a href="{{ route('voyages.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#30282077] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0000008e] focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">
                    Ajouter Voyage
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                @if ($voyages->isEmpty())
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">Aucun voyage disponible pour le moment.</span>
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Maticule</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Code QR</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Scan S Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Scan E Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Chauffeur ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Camion ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($voyages as $voyage)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voyage->mat }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        @if ($voyage->codeqr)
                                            <img src="data:image/svg+xml;base64,{{ $voyage->codeqr }}" alt="QR Code"
                                                class="w-24 h-24">
                                        @else
                                            Pas de QR Code disponible
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($voyage->scanS_date)
                                            {{ $voyage->scanS_date }}
                                        @else
                                            <span
                                                class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Non scanné</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($voyage->scanE_date)
                                            {{ $voyage->scanE_date }}
                                        @else
                                            <span
                                                class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Non scanné</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $voyage->chauffeur_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $voyage->camion_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                        @if (!$voyage->scanS_date)
                                            <a href="{{ route('voyages.edit', $voyage->mat) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fa-solid fa-pen-to-square" style="color: #f8bb4a;"></i>
                                            </a>
                                            <form action="{{ route('voyages.destroy', $voyage->mat) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fa-solid fa-trash" style="color: #ff1717;"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('voyages.show', $voyage->mat) }}"
                                            class="text-green-600 hover:text-green-900">
                                            <i class="fa-solid fa-info-circle" style="color: #4CAF50;"></i>
                                        </a>
                                        <!-- Print Button -->
                                        <button onclick="printDiv('printableArea-{{ $voyage->mat }}')"
                                            class="text-blue-600 hover:text-blue-900">
                                            <i class="fa-solid fa-print" style="color: #007bff;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Hidden div for printing -->
                                <div id="printableArea-{{ $voyage->mat }}" style="display: none;">
                                    <h2>Voyage Details</h2>
                                    <p><strong>Maticule:</strong> {{ $voyage->mat }}</p>

                                    <p><strong>Chauffeur ID:</strong> {{ $voyage->chauffeur_id }}</p>
                                    <div class="flex items-center mb-4">
                                        <div class="mr-4">
                                            <h3 class="text-xl font-semibold text-gray-700">Chauffeur:</h3>
                                            <p class="text-lg text-gray-600">{{ $voyage->chauffeur->nom }}
                                                {{ $voyage->chauffeur->prenom }}</p>
                                        </div>
                                        {{-- <div class="flex-shrink-0">
                                        @if ($voyage->chauffeur->image)

                                            <img src="{{ $voyage->chauffeur->image }}" alt="Image du Chauffeur"
                                                class="w-24 h-24 object-cover rounded-full border border-gray-300">
                                        @endif

                                    </div> --}}
                                    </div>
                                    <p><strong>Camion ID:</strong> {{ $voyage->camion_id }}</p>
                                    <p class="text-lg text-gray-600 mb-4"><strong
                                            class="text-2xl font-bold mb-2 text-gray-800">Camion Matricule:</strong>
                                        {{ $voyage->camion->matricule }}</p>
                                    @if ($voyage->codeqr)
                                        <img src="data:image/svg+xml;base64,{{ $voyage->codeqr }}" alt="QR Code"
                                            class="w-24 h-24">
                                    @else
                                        <p>Pas de QR Code disponible</p>
                                    @endif
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-6">
                        {{ $voyages->links() }}
                    </div>
                @endif
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
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            var myWindow = window.open('', 'Print', 'height=600,width=800');
            myWindow.document.write('<html><head><title>Print</title>');
            myWindow.document.write('<style>body { font-family: Arial, sans-serif; }</style>');
            myWindow.document.write('</head><body >');
            myWindow.document.write(content);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.focus();
            myWindow.print();

            myWindow.close();
        }
    </script>
</body>
