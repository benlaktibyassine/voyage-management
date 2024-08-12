<x-head title="Créer un Voyage"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Créer un Voyage</h1>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('voyages.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="chauffeur_id" class="block text-sm font-medium text-gray-700">Chauffeur</label>
                        <select name="chauffeur_id" id="chauffeur_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Choisir un Chauffeur</option>
                            @foreach ($chauffeurs as $chauffeur)
                                <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }} {{ $chauffeur->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="camion_id" class="block text-sm font-medium text-gray-700">Camion</label>
                        <select name="camion_id" id="camion_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="" disabled selected>Choisir un Camion</option>
                            @foreach ($camions as $camion)
                                <option value="{{ $camion->id }}">{{ $camion->matricule }}</option>
                            @endforeach
                        </select>
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
