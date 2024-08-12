<nav class="bg-[#171717]">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-[#c4bcb4] hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('dash') }}"><img class="h-8 w-auto" src="{{ url('images/menara.png') }}"
                            alt="Logo"></a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('commandes.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Commandes</a>
                        <a href="{{ route('dash') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Historiques</a>
                        <a href="{{ route('voyages.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Voyages</a>
                        <a href="{{ route('bon_livraisons.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Bon
                            livraison</a>
                        <a href="{{ route('admins.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Admins</a>
                        <a href="{{ route('produits.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Produits</a>
                        <a href="{{ route('chauffeurs.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Chauffeurs</a>
                        <a href="{{ route('camions.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Camions</a>
                        <a href="{{ route('securities.index') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Securite</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <button type="button"
                    class="relative rounded-full bg-[#d2cbcd] p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
                <div class="relative ml-3">
                    <div class="relative ml-3">
                        <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="button"
                                class="relative flex rounded-full bg-[#726d69] text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 text-white px-4 py-2"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('commandes.index') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Commandes</a>
            <a href="{{ route('dash') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Historiques</a>
            <a href="{{ route('voyages.index') }}"
                class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Voyages</a>
            <a href="{{ route('bon_livraisons.index') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Bon
                livraison</a>
            <a href="{{ route('admins.index') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Admins</a>
            <a href="{{ route('produits.index') }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Produits</a>
            <a href="{{ route('chauffeurs.index') }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Chauffeurs</a>
            <a href="{{ route('camions.index') }}"
                class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#c4bcb4]">Camions</a>

        </div>
    </div>
</nav>
