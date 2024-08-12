<x-head title="Login"></x-head>

<body class="flex h-screen m-0 font-sans bg-[#171717]">
    <div class="flex w-full">
        <div class="flex flex-1 justify-center items-center bg-[#171717] ml-10">
            <img src="{{ url('images/menara.png') }}" alt="Logo" class="max-w-4/5 h-auto ">
        </div>
        <div class="flex flex-1 justify-center items-center bg-[#171717]">
            <div class="bg-white p-5 rounded-lg shadow-md w-72">
                <h2 class="text-center text-[#171717] text-3xl mb-4">Login </h2>
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <label for="username" class="block text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" required
                        class="w-full p-2 mb-3 border border-gray-300 rounded-lg">

                    <label for="password" class="block text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-2 mb-3 border border-gray-300 rounded-lg">

                    <button type="submit"
                        class="w-full p-2 bg-[#171717] text-white rounded-lg hover:bg-gray-600">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
