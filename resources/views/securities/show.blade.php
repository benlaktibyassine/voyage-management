<x-head title="Détails de la Sécurité"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ $securitie->nom }} {{ $securitie->prenom }}</h1>
                <p class="text-gray-600"><strong>Numéro de Badge:</strong> {{ $securitie->num_badge }}</p>
                <p class="text-gray-600"><strong>CIN:</strong> {{ $securitie->cin }}</p>
                <p class="text-gray-600"><strong>Téléphone:</strong> {{ $securitie->telephone }}</p>
                <div class="mt-4">
                    <a href="{{ route('securities.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Retour
                        à la liste</a>
                </div>
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
