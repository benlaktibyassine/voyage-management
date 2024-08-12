<x-head title="Bons Livraison"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Bons de Livraison</h1>
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
            <div class="mb-4">
                <a href="{{ route('bon_livraisons.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#a39475] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#81745a] focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Ajouter
                    Un Bon de Livraison</a>
            </div>

            <!-- Search Form -->
            <div class="mb-6">
                <form method="GET" action="{{ route('bon_livraisons.index') }}" >
                    <div class="grid grid-cols-8 gap-4">
                        <input type="text" name="search_id" placeholder="ID"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_id') }}">

                        <input type="text" name="search_date" placeholder="Date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_date') }}">

                        <select name="search_status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="">Status</option>
                            <option value="scaned" {{ request()->query('search_status') == 'scaned' ? 'selected' : '' }}>Scaned</option>
                            <option value="not_scaned" {{ request()->query('search_status') == 'not_scaned' ? 'selected' : '' }}>Not Scaned</option>
                        </select>

                        <input type="text" name="search_voyage" placeholder="Voyage"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_voyage') }}">

                        <input type="text" name="search_commande" placeholder="Commande"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_commande') }}">

                        <input type="text" name="search_nbr_scanS" placeholder="Scan Sortie"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_nbr_scanS') }}">

                        <input type="text" name="search_nbr_scanE" placeholder="Scan Entrée"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request()->query('search_nbr_scanE') }}">

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#a39475] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#171717] focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Rechercher</button>
                    </div>
                </form>
            </div>

            @if ($bonLivraisons->isEmpty())
                <p class="text-gray-600">Aucun bon de livraison trouvé.</p>
            @else
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            {{-- <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Code Bare</th> --}}
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">ID</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Date</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Status</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Voyage</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Commande</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Nombre de Scan Sortie</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Nombre de Scan Entrée</th>
                            <th class="py-3 px-6 border-b font-medium text-gray-700 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonLivraisons as $note)
                            <tr class="hover:bg-gray-100">
                                {{-- <td class="py-4 px-6 border-b text-gray-800">
                                    {!! DNS1D::getBarcodeSVG((string) $note->id, 'C128') !!}

                                </td> --}}
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->id }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->created_at->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-6 border-b text-gray-800">
                                    <span
                                        class="inline-block px-2 py-1 text-sm {{ $note->scaned == 1 ? 'text-green-800 bg-green-200' : 'text-red-800 bg-red-200' }} rounded-full">
                                        {{ $note->scaned == 1 ? 'Scaned' : 'Not Scaned' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->voyage_id }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->cmd_id }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->nbr_scanS }}</td>
                                <td class="py-4 px-6 border-b text-gray-800">{{ $note->nbr_scanE }}</td>
                                <td class="py-4 px-6 border-b text-gray-800 flex space-x-2">
                                    <a href="{{ route('bon_livraisons.show', $note->id) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fa-solid fa-info-circle" style="color: #4CAF50;"></i>
                                    </a>
                                    @if ($note->scaned != 1)
                                        <a href="{{ route('bon_livraisons.edit', $note->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fa-solid fa-pen-to-square" style="color: #f8bb4a;"></i>
                                        </a>
                                        <form action="{{ route('bon_livraisons.destroy', $note->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fa-solid fa-trash" style="color: #ff1717;"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <div class="mt-4">
                {{ $bonLivraisons->appends(request()->query())->links() }}
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
