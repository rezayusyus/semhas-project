@extends('layouts.app')

@section('title', 'Keranjang Anda')

@section('content')
    <section class="py-16 bg-background text-primary">
        <div class="container mx-auto">
            <h1 class="text-4xl font-extrabold text-center mb-10" data-aos="fade-down">Keranjang Anda</h1>

            <!-- Keranjang -->
            <div id="cart-container" class="bg-primary text-background p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Detail Keranjang</h2>
                    <button id="clear-cart"
                        class="bg-red-500 text-background px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        Kosongkan Keranjang
                    </button>
                </div>
                <div id="cart-items" class="space-y-4"></div>
                <div class="flex justify-between items-center mt-6">
                    <h3 class="text-xl font-semibold">Total:</h3>
                    <p id="cart-total" class="text-2xl font-bold">Rp 0</p>
                </div>
                <button
                    class="bg-background text-primary w-full py-3 mt-6 rounded-lg shadow-lg hover:bg-white hover:text-primary transition"
                    onclick="checkout()">Checkout</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const cartContainer = document.getElementById('cart-container');
        const cartItemsContainer = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');

        // Load keranjang dari localStorage
        const loadCart = () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            cartItemsContainer.innerHTML = '';

            let total = 0;

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p class="text-center text-lg">Keranjang Anda kosong!</p>';
                cartTotal.textContent = 'Rp 0';
                return;
            }

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                // Buat elemen untuk item keranjang
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('flex', 'justify-between', 'items-center', 'border-b',
                    'border-background', 'pb-2');
                itemDiv.innerHTML = `
                <div class="flex items-center space-x-4">
                    <input type="checkbox" class="item-checkbox" data-index="${index}" />
                    <div>
                        <h4 class="font-semibold">${item.name}</h4>
                        <p class="text-sm">Rp ${item.price.toLocaleString()} x ${item.quantity}</p>
                        <p class="text-sm">Tanggal Penyewaan: ${item.date}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-red-500 text-background px-3 py-1 rounded-lg hover:bg-red-600 transition"
                        onclick="removeFromCart(${index})">Hapus</button>
                </div>
            `;

                cartItemsContainer.appendChild(itemDiv);
            });

            cartTotal.textContent = `Rp ${total.toLocaleString()}`;
        };

        // Tambah fungsi untuk hapus item
        const removeFromCart = (index) => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        };

        // Kosongkan keranjang
        document.getElementById('clear-cart').addEventListener('click', () => {
            localStorage.removeItem('cart');
            loadCart();
        });

        // Checkout hanya untuk item terpilih
        const checkout = () => {
                const checkboxes = document.querySelectorAll('.item-checkbox:checked');
                const cart ``
                `javascript
= JSON.parse(localStorage.getItem('cart')) || [];

        if (checkboxes.length === 0) {
            alert('Pilih item yang ingin di-checkout.');
            return;
        }

        const selectedItems = [];
        checkboxes.forEach(checkbox => {
            const index = checkbox.dataset.index;
            selectedItems.push(cart[index]);
        });

        alert(`
                Checkout berhasil untuk $ {
                    selectedItems.length
                }
                item.Silakan lanjutkan ke pembayaran.
                `);

                    // Hapus item yang di-checkout dari keranjang
                    const remainingItems = cart.filter((_, index) => ![...checkboxes].some(checkbox => checkbox.dataset.index == index));
                    localStorage.setItem('cart', JSON.stringify(remainingItems));
                    loadCart();
                };

                // Tambah item ke keranjang
                const addToCart = (name, price, quantity, date) => {
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    cart.push({
                        name,
                        price,
                        quantity,
                        date
                    });
                    localStorage.setItem('cart', JSON.stringify(cart));
                    loadCart();
                };

                // Inisialisasi keranjang
                loadCart();
    </script>
@endpush
