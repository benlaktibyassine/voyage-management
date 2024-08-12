<x-head title="Liste des Commandes"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Liste des Commandes</h1>

                <!-- Search Form -->
                <form method="GET" action="{{ route('commandes.index') }}" class="mb-6" id="search-form">
                    <div class="flex items-center bg-white border border-[#cccccc67] rounded-lg shadow-sm">
                        <input type="text" name="search" id="search" placeholder="Rechercher une commande..."
                            class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300 rounded-l-lg"
                            value="{{ request()->query('search') }}">
                        <div class="px-4 text-gray-500">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    État</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Devis</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Client</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody id="commandes-table" class="bg-white">
                            @foreach ($commandes as $commande)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $commande->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $commande->description }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $commande->devis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <a href="{{ route('commandes.show', $commande->id) }}"
                                            class="text-gray-500 hover:text-gray-700">
                                            <i class="fa-solid fa-eye text-[#84dd84f3]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $commandes->links('pagination::tailwind') }}
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

    @vite('resources/js/app.js')
</body>

</html>
