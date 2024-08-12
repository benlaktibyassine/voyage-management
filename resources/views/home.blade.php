<x-head title="Dashboard"></x-head>

<body>
    @if (Session::get('user_type') == 'admin')
        <x-navbar></x-navbar>
        {{-- <x-sidebar></x-sidebar> --}}
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Historiques</h1>

            <!-- Table -->
            <form method="GET" action="{{ route('dash') }}">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Id
                                <input type="text" name="id" value="{{ request('id') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Filter by ID">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                                <input type="date" name="created_at" value="{{ request('created_at') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Filter by Date">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Matricule Voyage
                                <input type="text" name="voyage_mat" value="{{ request('voyage_mat') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Filter by Matricule">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Badge Securite
                                <input type="text" name="security_badge" value="{{ request('security_badge') }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Filter by Badge">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                                <select name="status"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">All</option>
                                    <option value="sortie" {{ request('status') == 'sortie' ? 'selected' : '' }}>Sortie</option>
                                    <option value="entree" {{ request('status') == 'entree' ? 'selected' : '' }}>Entree</option>
                                    <option value="erreur" {{ request('status') == 'erreur' ? 'selected' : '' }}>Erreur</option>
                                </select>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                                <button type="submit"
                                        class="mt-1 block px-3 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md">
                                    Filter
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($historiques as $historique)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $historique->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $historique->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $historique->voyage_mat }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $historique->security_badge }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $historique->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('voyages.show', $historique->voyage_mat) }}"
                                       class="hover:bg-[#17171786] rounded-full bg-[#171717] p-2 text-gray-50">
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <div class="mt-4">
                {{ $historiques->links() }}
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
        function dropDown() {
            document.querySelector('#submenu').classList.toggle('hidden')
            document.querySelector('#arrow').classList.toggle('rotate-0')
        }
        dropDown()

        function Openbar() {
            document.querySelector('.sidebar').classList.toggle('left-[-300px]')
        }
    </script>
    @vite('resources/js/app.js')
</body>

</html>
