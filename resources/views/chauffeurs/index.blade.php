<x-head title="Liste des Chauffeurs"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-6 text-gray-800">Liste des Chauffeurs</h1>
            <div class="mb-6">
                <form action="{{ route('chauffeurs.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                        class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2">
                    <button type="submit"
                        class="ml-4 px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">Rechercher</button>
                </form>
            </div>
            <div class="mb-4">
                <a href="{{ route('chauffeurs.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Ajouter
                    Chauffeur</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($chauffeurs as $chauffeur)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden relative">
                        <img src="data:image/jpeg;base64,{{ base64_encode($chauffeur->image) }}"
                            alt="{{ $chauffeur->nom }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <a href="{{ route('chauffeurs.show', $chauffeur->id) }}">
                                <h2 class="text-xl font-semibold text-gray-800">{{ $chauffeur->nom }}
                                    {{ $chauffeur->prenom }}</h2>
                            </a>
                            <p class="text-gray-600 mt-2">{{ $chauffeur->telephone }}</p>
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('chauffeurs.edit', $chauffeur->id) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-pen-to-square" style="color: #3b82f6;"></i>
                                </a>
                                <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}" method="POST"
                                    onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $chauffeurs->appends(['search' => request('search')])->links() }}
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
    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this chauffeur?')) {
                event.preventDefault();
            }
        }
    </script>
</body>
