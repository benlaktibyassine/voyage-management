<x-head title="Modifier Admin"></x-head>

<body class="bg-customSilver">
    @if (Session::has('user_type') == 'admin')
        <x-navbar></x-navbar>

        <div class="flex justify-center items-center min-h-screen">
            <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center" style="color: #a39475;">Edit Admin</h2>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <strong>Error!</strong> Please check the form below for errors
                    </div>
                @endif

                <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium" style="color: #a39475;">Nom</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $admin->nom) }}"
                            class="mt-1 block w-full px-3 py-2 border @error('nom') border-red-500 @enderror border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-customGold focus:border-customGold sm:text-sm"
                            required>
                        @error('nom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="prenom" class="block text-sm font-medium" style="color: #a39475;">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $admin->prenom) }}"
                            class="mt-1 block w-full px-3 py-2 border @error('prenom') border-red-500 @enderror border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-customGold focus:border-customGold sm:text-sm"
                            required>
                        @error('prenom')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium" style="color: #a39475;">Username</label>
                        <input type="text" id="username" name="username"
                            value="{{ old('username', $admin->username) }}"
                            class="mt-1 block w-full px-3 py-2 border @error('username') border-red-500 @enderror border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-customGold focus:border-customGold sm:text-sm"
                            required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium" style="color: #a39475;">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full px-3 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-customGold focus:border-customGold sm:text-sm"
                            required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="w-full bg-customGold text-white py-2 px-4 rounded hover:bg-customBronze focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-customGold">Update
                            Admin</button>
                    </div>
                </form>
            </div>
        </div>
</body>
