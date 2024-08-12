<x-head title="Scaner Qr code"></x-head>

<body class="flex justify-center items-center h-screen bg-[#171717] m-0 p-0 box-border">
    <div class="absolute top-0 left-0 p-4">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center px-4 py-2 bg-[#3e4643] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0000008e] focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
            <i class="fa-solid fa-arrow-left"></i> Go Back
        </a>
    </div>

    <div class="absolute top-0 right-0 p-4">
        <a href="{{ route('securitie.logout') }}"
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-red-700 focus:ring ring-gray-300 active:bg-red-700 disabled:opacity-25 transition ease-in-out duration-150">
            <i class="fa-solid fa-sign-out-alt"></i>
        </a>
    </div>

    <div class="w-full max-w-md mx-5 text-center">
        <div class="flex justify-center items-center mb-5">
            <a href="{{ route('securitie_dashboard') }}">
                <img src="{{ url('images/menara.png') }}" alt="Logo" class="max-w-4/5 h-auto">
            </a>
        </div>
        <h1 class="text-2xl text-[#d2cbcd] mb-5">Scaner QR Code</h1>
        <div class="bg-[#c4bcb4] p-7 border border-[#a39475] rounded-md shadow-lg">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('message'))
                @if (session('statu') == 0)
                {{-- @dd(session('statu')) --}}
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @else
                {{-- @dd(session('statu')) --}}

                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @endif
            @endif


            <form id="scanForm" action="{{ route('scanner', ['badge' => session('user_id'), 'status' => $status]) }}"
                method="POST">
                @csrf
                <div class="mb-4">
                    <label for="mat" class="block text-[#171717] mb-2">Numero de Voyage</label>
                    <input type="text" id="mat" name="mat"
                        class="w-full p-2 border border-[#a39475] rounded-md">
                    @error('mat')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" id="submitBtn"
                    class="mt-4 w-full p-2 rounded-md bg-[#171717] text-cyan-50">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
