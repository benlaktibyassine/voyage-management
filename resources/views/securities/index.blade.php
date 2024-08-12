<x-head title="Liste des Sécurités"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif

            <h1 class="text-3xl font-bold mb-6 text-gray-800">Liste des Sécurités</h1>

            <div class="mb-4">
                <a href="{{ route('securities.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-gray-300 active:bg-blue-700 disabled:opacity-25 transition ease-in-out duration-150">Ajouter
                    Sécurité</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Numéro de Badge</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Usename</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prénom</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                CIN</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Téléphone</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($securities as $securitie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $securitie->num_badge }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $securitie->username }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $securitie->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $securitie->prenom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $securitie->CIN }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $securitie->telephone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('securities.show', $securitie->num_badge) }}"
                                        class="text-[#5876ac] hover:text-blue-700">
                                        <i class="fa-solid fa-eye" style="color:#58ac9e;"></i>
                                    </a>
                                    <a href="{{ route('securities.edit', $securitie->num_badge) }}"
                                        class="text-[#01940e] hover:text-blue-700">
                                        <i class="fa-solid fa-pen-to-square" style="color: #01940e;"></i>
                                    </a>
                                    <form action="{{ route('securities.destroy', $securitie->num_badge) }}"
                                        method="POST" onsubmit="return confirmDelete(event)" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ">
                                            <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $securities->links() }}
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
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this sécurité?')) {
                event.preventDefault();
            }
        }
    </script>
</body>
