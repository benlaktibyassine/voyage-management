<x-head title="Ajouter Chauffeur"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Ajouter un Chauffeur</h1>

            <form action="{{ route('chauffeurs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                    <input type="text" name="nom" id="nom"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                    <input type="text" name="prenom" id="prenom"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700 font-medium">Téléphone</label>
                    <input type="text" name="telephone" id="telephone"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium">Image</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">Ajouter
                        Chauffeur</button>
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
