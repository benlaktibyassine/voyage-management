<x-head title="Produits"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Liste des Produits</h1>
            <form id="search-form" action="{{ route('produits.index') }}" method="GET" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="search" id="search-input" value="{{ request()->query('search') }}"
                        placeholder="Rechercher par nom ou prix..."
                        class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2">
                    <button type="submit"
                        class="ml-4 px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">Rechercher</button>
                </div>
            </form>

            <div class="mb-4">
                <a href="{{ route('produits.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#a39475] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#8a7d60] focus:outline-none focus:border-[#8a7d60] focus:ring ring-gray-300 active:bg-[#8a7d60] disabled:opacity-25 transition ease-in-out duration-150">Ajouter
                    Produit</a>
            </div>

            <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($produits as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                        <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" alt="{{ $product->nom }}"
                            class="w-full h-48 object-cover">
                        <div class="p-4 flex-1 flex flex-col">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $product->nom }}</h2>
                            <p class="text-gray-600 mt-2 mb-auto">{{ $product->prix }} €</p>
                            <div class="flex justify-end space-x-2 mt-4">
                                <a href="{{ route('produits.edit', $product->id) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-pen-to-square" style="color: #3b82f6;"></i>
                                </a>
                                <button type="button" class="text-red-500 hover:text-red-700"
                                    onclick="openConfirmModal({{ $product->id }})">
                                    <i class="fa-solid fa-trash" style="color: #ef4444;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Custom Confirmation Modal -->
        <div id="confirm-modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 17h8m0 0V9m0 8l-8-8m8 8H5m8 8V5" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Supprimer le
                                    produit</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Êtes-vous sûr de vouloir supprimer ce produit?
                                        Cette action est irréversible.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="delete-form" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Supprimer
                            </button>
                        </form>
                        <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            onclick="closeConfirmModal()">
                            Annuler
                        </button>
                    </div>
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
    <!-- JavaScript for AJAX and Custom Confirmation Modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: '{{ route('produits.search') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(data) {
                        $('#product-list').html(data);
                    }
                });
            });
        });

        function openConfirmModal(productId) {
            const deleteForm = document.getElementById('delete-form');
            deleteForm.action = '{{ route('produits.destroy', ':id') }}'.replace(':id', productId);
            document.getElementById('confirm-modal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
        }
    </script>
</body>
