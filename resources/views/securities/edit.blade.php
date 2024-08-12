<x-head title="Modifier une Sécurité"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h1 class="text-xl font-bold mb-4 text-gray-800">Modifier une Sécurité</h1>

                @if ($errors->any())
                    <div class="mb-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('securities.update', $security->num_badge) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="nom" id="nom"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('nom', $security->nom) }}">
                    </div>

                    <div class="mb-3">
                        <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="prenom" id="prenom"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('prenom', $security->prenom) }}">
                    </div>

                    <div class="mb-3">
                        <label for="cin" class="block text-sm font-medium text-gray-700">CIN</label>
                        <input type="text" name="cin" id="cin"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('cin', $security->CIN) }}">
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" id="telephone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('telephone', $security->telephone) }}">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="block text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            value="{{ old('username', $security->username) }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <p class="text-sm text-gray-500">Laissez ce champ vide si vous ne souhaitez pas modifier le mot
                            de passe.</p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 bg-[#a39475] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">
                            Mettre à jour
                        </button>
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
