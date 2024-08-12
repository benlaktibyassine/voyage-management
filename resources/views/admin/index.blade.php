<x-head title="Admins"></x-head>

<body class="bg-gray-100">
    @if (Session::has('user_type') == 'admin')

        <x-navbar></x-navbar>

        <div class="container mx-auto py-8">
            <h2 class="text-3xl font-bold mb-6 text-center" style="color: #a39475;">List of Admins</h2>

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

            <div class="mb-4">
                <a href="{{ route('admins.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#a39475] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#8a7d60] focus:outline-none focus:border-[#8a7d60] focus:ring ring-gray-300 active:bg-[#8a7d60] disabled:opacity-25 transition ease-in-out duration-150">Add
                    Admin</a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID</th>
                            <th
                                class="px-5 py-3 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nom</th>
                            <th
                                class="px-5 py-3 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Prénom</th>
                            <th
                                class="px-5 py-3 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Username</th>
                            <th
                                class="px-5 py-3 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->id }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->nom }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->prenom }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $admin->username }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        <i class="fa-solid fa-pen-to-square" style="color: #f8bb4a;"></i>
                                    </a>
                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                            <i class="fa-solid fa-trash" style="color: #ff1717;"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="text-yellow-600 hover:text-yellow-900 ml-2"
                                        onclick="confirmRegeneratePassword({{ $admin->id }})">
                                        <i class="fa-solid fa-redo"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $admins->links() }}</div>
        </div>

        <!-- Confirmation Modal -->
        <div id="confirmModal" class="fixed inset-0  items-center justify-center bg-gray-800 bg-opacity-75 hidden">
            <div class="bg-white p-6 rounded shadow-md text-center">
                <p class="mb-4">Are you sure you want to regenerate the password for this admin?</p>
                <button id="confirmButton"
                    class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Confirm</button>
                <button onclick="closeConfirmModal()"
                    class="bg-gray-600 text-white py-2 px-4 rounded hover:bg-gray-700 ml-2">Cancel</button>
            </div>
        </div>

        <form id="regeneratePasswordForm" action="" method="POST" class="hidden">
            @csrf
            @method('POST')
        </form>
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
    <!-- JavaScript to handle the confirmation modal -->
    <script>
        function confirmRegeneratePassword(adminId) {
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('regeneratePasswordForm').action = '/admins/' + adminId + '/regenerate-password';
        }

        document.getElementById('confirmButton').addEventListener('click', function() {
            document.getElementById('regeneratePasswordForm').submit();
        });

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>
</body>
