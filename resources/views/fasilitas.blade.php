@extends('layouts.app')

@section('title', 'Fasilitas')

@section('content')
    <section class="py-16 bg-background text-primary">
        <div class="container mx-auto">
            <h1 class="text-4xl font-extrabold text-center mb-10">Fasilitas Wisata Germanggis</h1>

            <!-- Tabs for Categories -->
            <div class="flex justify-center space-x-4 mb-10">
                <button class="category-tab bg-primary text-background px-6 py-3 rounded-lg"
                    data-category="tiket">Tiket</button>
                <button class="category-tab bg-primary text-background px-6 py-3 rounded-lg" data-category="camping">Paket
                    Camping</button>
                <button class="category-tab bg-primary text-background px-6 py-3 rounded-lg" data-category="tools">Alat
                    Camping</button>
                <button class="category-tab bg-primary text-background px-6 py-3 rounded-lg"
                    data-category="accommodation">Penginapan</button>
            </div>

            <!-- Content for Categories -->
            @foreach (['camping', 'tools', 'accommodation', 'tiket'] as $category)
                <!-- Tambahkan 'tiket' di sini -->
                <div id="{{ $category }}" class="category-content {{ $loop->first ? 'block' : 'hidden' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($categories[$category] ?? [] as $item)
                            <div class="p-4 bg-white shadow rounded-lg">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                    class="w-full h-48 object-cover rounded-lg mb-4">
                                <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-700">{!! nl2br(e($item->description)) !!}</p>
                                <p class="text-lg font-bold mt-2">Rp{{ number_format($item->price, 0, ',', '.') }}</p>

                                <!-- Input Tanggal Pemesanan -->
                                <label for="booking-date-{{ $item->id }}" class="block mt-4 text-sm">Tanggal
                                    Pemesanan:</label>
                                <input type="date" id="booking-date-{{ $item->id }}"
                                    class="w-full border rounded-lg px-4 py-2 mt-2">

                                <button class="mt-4 bg-primary text-white py-2 px-4 rounded-lg hover:bg-accent"
                                    onclick="addToCart('{{ $item->name }}', {{ $item->price }}, 1, document.getElementById('booking-date-{{ $item->id }}').value)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

<script>
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.getAttribute('data-category');

            // Sembunyikan semua kategori
            document.querySelectorAll('.category-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Tampilkan kategori yang dipilih
            document.getElementById(category).classList.remove('hidden');
        });
    });

    function addToCart(name, price, quantity) {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItemIndex = cart.findIndex(item => item.name === name);

        if (existingItemIndex > -1) {
            // Jika item sudah ada, tambahkan kuantitas
            cart[existingItemIndex].quantity += quantity;
        } else {
            // Jika item belum ada, tambahkan item baru
            cart.push({
                name,
                price,
                quantity
            });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${name} telah ditambahkan ke keranjang!`);
    }
</script>
