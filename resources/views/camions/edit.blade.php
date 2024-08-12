<x-head title="Modifier Camion"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Modifier le Camion</h1>

            <form action="{{ route('camions.update', $camion->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="matricule" class="block text-gray-700 font-medium">Matricule</label>
                    <input type="text" name="matricule" id="matricule"
                        value="{{ old('matricule', $camion->matricule) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('matricule')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="marque" class="block text-gray-700 font-medium">Marque</label>
                    <input type="text" name="marque" id="marque" value="{{ old('marque', $camion->marque) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('marque')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="modele" class="block text-gray-700 font-medium">Modèle</label>
                    <input type="text" name="modele" id="modele" value="{{ old('modele', $camion->modele) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('modele')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">Mettre à jour
                        le Camion</button>
                </div>
            </form>
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
