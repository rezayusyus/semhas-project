<header class="bg-primary text-background py-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="text-xl font-bold">
            <a href="{{ route('home') }}" class="hover:underline">
                <img src="{{ asset('images/logo.png') }}" alt="Wisata Germanggis" class="w-auto h-10">
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-6 items-center">
            <a href="{{ route('home') }}" class="hover:underline hover:text-accent transition">Beranda</a>
            <a href="{{ route('wahana') }}" class="hover:underline hover:text-accent transition">Wahana</a>
            <a href="{{ route('fasilitas') }}" class="hover:underline hover:text-accent transition">Fasilitas</a>
            <a href="{{ route('keranjang') }}" class="hover:underline hover:text-accent transition">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <a href="{{ route('pesanan') }}" class="hover:underline hover:text-accent transition">
                <i class="fa-solid fa-receipt"></i>
            </a>

            <!-- Authentication -->
            @if (Auth::check())
                <div class="relative group">
                    <button class="hover:underline">
                        {{ Auth::user()->name }}
                    </button>
                    <div
                        class="absolute right-0 bg-background text-primary mt-2 rounded shadow-lg hidden group-hover:block">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-primary hover:text-background">
                            Profil
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button
                                class="block w-full text-left px-4 py-2 hover:bg-primary hover:text-background">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:underline hover:text-accent transition">Login</a>
                <a href="{{ route('register') }}" class="hover:underline hover:text-accent transition">Daftar</a>
            @endif
        </nav>

        <!-- Mobile Menu Toggle -->
        <button class="md:hidden text-2xl" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden bg-background text-primary p-4 space-y-4 md:hidden" id="mobile-menu">
        <a href="{{ route('home') }}" class="block hover:underline">Beranda</a>
        <a href="{{ route('wahana') }}" class="block hover:underline">Wahana</a>
        <a href="{{ route('fasilitas') }}" class="block hover:underline">Fasilitas</a>
        <a href="{{ route('keranjang') }}" class="block hover:underline">
            <i class="fa-solid fa-cart-shopping"></i> Keranjang
        </a>
        <a href="{{ route('pesanan') }}" class="block hover:underline">
            <i class="fa-solid fa-receipt"></i> Pesanan
        </a>

        <!-- Authentication -->
        @if (Auth::check())
            <a href="{{ route('profile') }}" class="block hover:underline">Profil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="block w-full text-left hover:underline">Keluar</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block hover:underline">Login</a>
            <a href="{{ route('register') }}" class="block hover:underline">Daftar</a>
        @endif
    </div>
</header>

@push('scripts')
    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
@endpush
