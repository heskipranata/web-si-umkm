@include('partials.header')
@include('partials.navbar')
<section id="home"
    class="relative h-screen flex pt-32 md:pt-64 justify-center text-white text-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/bg.jpg') }}')">
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-5xl z-10 mx-auto px-6 md:px-12">
        <h1 class="text-4xl md:text-6xl font-bold text-green-500 drop-shadow-lg">
            Rasakan Kelezatan Hidangan Lokal & Modern 🍽️
        </h1>
        <p class="mt-4 text-lg text-white drop-shadow">
            Makanjo menyajikan pengalaman kuliner terbaik dengan cita rasa otentik,
            sentuhan modern, dan suasana yang nyaman. Temukan menu favoritmu dan nikmati momen istimewa bersama keluarga
            & teman! 😋
        </p>
        <a href="#menu"
            class="mt-6 inline-block bg-green-500 text-white text-lg font-semibold px-6 py-3 rounded hover:bg-green-600 transition">
            Pesan Sekarang 🍴
        </a>
    </div>
</section>

<section id="tentang" class="py-32 bg-green-500">
    <div class="container mx-auto flex flex-col md:flex-row items-stretch px-6 md:px-12 gap-12">

        <div class="md:w-1/2 h-full">
            <img src="{{ asset('images/bg2.jpg') }}" alt="Tentang Makanjo"
                class="rounded-lg shadow-lg object-cover w-full h-full max-h-[400px]" />
        </div>

        <div class="md:w-1/2 flex flex-col justify-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Tentang Makanjo</h2>
            <p class="text-gray-100 text-xl mb-6 leading-relaxed">
                Terletak di jantung <span class="font-semibold text-green-800">kota Manado</span>, Makanjo hadir sebagai
                restoran yang menggabungkan cita rasa <strong>kuliner lokal</strong> dengan sentuhan <strong>modern dan
                    elegan</strong>. Kami berkomitmen menyajikan hidangan berkualitas tinggi menggunakan bahan-bahan
                segar pilihan dari tanah Sulawesi.
            </p>
            <p class="text-gray-100 text-lg leading-relaxed">
                Dari suasana yang hangat hingga pelayanan ramah, Makanjo adalah tempat ideal untuk menikmati makan
                bersama keluarga, teman, ataupun pertemuan bisnis. Mari ciptakan momen istimewa di kota Manado bersama
                kami!
            </p>
        </div>

    </div>
</section>

<section id="menu" class="py-20 bg-white">
    <div class="container mx-auto px-6 md:px-12 text-center">
        <h2 class="text-4xl font-bold text-green-700 mb-2">Menu Kami</h2>
        <p class="text-lg text-gray-700 mb-10">Silakan pesan hidangan favorit Anda langsung dari menu di bawah ini 🍽️
        </p>

        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Makanan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach ($makanan as $item)
                <div class="bg-white border border-green-500 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset($item->image) }}"
                        alt="{{ $item->name }}" class="w-full h-40 object-cover rounded mb-4">
                    <h4 class="text-xl font-semibold text-gray-800">{{ $item->name }}</h4>
                    <p class="text-green-600 font-bold mt-2">Rp{{ $item->price }}</p>
                    <button
                        onclick="addToCart({ id: {{ $item->id }}, name: '{{ $item->name }}', price: {{ $item->price }} })"
                        class="mt-4 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">
                        Pesan
                    </button>

                </div>
            @endforeach
        </div>

        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Minuman</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($minuman as $item)
                <div class="bg-white border border-green-500 rounded-lg shadow hover:shadow-lg transition p-4">
                    <img src="{{ asset($item->image) }}" alt="Nasi Goreng"
                        class="w-full h-40 object-cover rounded mb-4">
                    <h4 class="text-xl font-semibold text-gray-800">{{ $item->name }}</h4>
                    <p class="text-green-600 font-bold mt-2">Rp{{ $item->price }}</p>
                    <button
                        onclick="addToCart({ id: {{ $item->id }}, name: '{{ $item->name }}', price: {{ $item->price }} })"
                        class="mt-4 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">
                        Pesan
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="kontak" class="py-20 bg-white text-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-center text-green-500 mb-8">
            Hubungi Kami 📞
        </h2>
        <p class="text-center text-green-900 mb-12 md:px-72 font-bold">
            Untuk keperluan bisni, saran, komentar dan laporan silahkan hubungi kami dengan mengirimkan pesan melalui
            form berikut. Kami siap membantu Anda 🫡!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="col-span-1 ">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255256.04460025943!2d124.7844865!3d1.540815549999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32879ef9ffb30fd3%3A0x3030bfbcaf77280!2sManado%2C%20Manado%20City%2C%20North%20Sulawesi!5e0!3m2!1sen!2sid!4v1746919976756!5m2!1sen!2sid"
                    class="w-full h-80 rounded-lg shadow-lg" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="col-span-1">
                <form action="" class="space-y-4 bg-gray-200 p-3 rounded-lg shadow-lg">
                    <div class="flex gap-4">
                        <input type="text" placeholder="Nama"
                            class="w-full p-3 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all ease-in-out duration-300 border-2 border-gray-300" />
                        <input type="text" placeholder="Telepon"
                            class="w-full p-3 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all ease-in-out duration-300 border-2 border-gray-300" />
                    </div>

                    <div class="input-group flex flex-col gap-2">
                        <input type="email" placeholder="Email"
                            class="w-full p-3 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all ease-in-out duration-300 border-2 border-gray-300" />
                    </div>

                    <div class="input-group flex flex-col gap-2">
                        <textarea placeholder="Kritik & Saran" rows="3"
                            class="w-full p-3 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all ease-in-out duration-300 border-2 border-gray-300"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
@include('partials.sidebar')
<script>
    let cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartContent = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');

    // Fungsi untuk menampilkan/menyembunyikan sidebar keranjang
    window.toggleCart = function() {
        cartSidebar.classList.toggle('translate-x-full');
        renderCart(); // Pastikan keranjang dirender ulang ketika sidebar dibuka
    };

    // Fungsi untuk menambah item ke keranjang
    window.addToCart = function(item) {
        const existing = cartItems.find(i => i.id === item.id);
        if (existing) {
            existing.qty += 1; // Jika item sudah ada, tambahkan jumlahnya
        } else {
            cartItems.push({
                ...item,
                qty: 1
            }); // Jika belum ada, tambahkan item baru
        }

        // Simpan ke localStorage
        localStorage.setItem('cart', JSON.stringify(cartItems));

        renderCart(); // Update tampilan keranjang
        updateCartBadge(); // Perbarui jumlah di badge
        cartSidebar.classList.remove('translate-x-full'); // Tutup sidebar setelah menambah
    };

    // Fungsi untuk menaikkan jumlah item
    window.increaseQty = function(index) {
        cartItems[index].qty += 1;
        localStorage.setItem('cart', JSON.stringify(cartItems)); // Simpan perubahan ke localStorage
        renderCart();
        updateCartBadge();
    };

    // Fungsi untuk menurunkan jumlah item
    window.decreaseQty = function(index) {
        if (cartItems[index].qty > 1) {
            cartItems[index].qty -= 1;
        } else {
            cartItems.splice(index, 1); // Jika jumlahnya 1, hapus item
        }
        localStorage.setItem('cart', JSON.stringify(cartItems)); // Simpan perubahan ke localStorage
        renderCart();
        updateCartBadge();
    };

    // Fungsi untuk merender tampilan keranjang
    function renderCart() {
        let total = 0;
        let html = '';

        if (cartItems.length === 0) {
            cartContent.innerHTML = '<p class="text-gray-500 text-center">Keranjang masih kosong.</p>';
            cartTotal.textContent = 'Rp0';
            return;
        }

        cartItems.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            total += subtotal;

            html += `
        <div class="border-b pb-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-bold text-gray-800">${item.name}</p>
                    <p class="text-sm text-gray-600">Rp${item.price.toLocaleString()} x ${item.qty}</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="decreaseQty(${index})" class="bg-gray-200 px-2 rounded hover:bg-gray-300 text-red-600 font-bold">−</button>
                    <span>${item.qty}</span>
                    <button onclick="increaseQty(${index})" class="bg-gray-200 px-2 rounded hover:bg-gray-300 text-blue-600 font-bold">+</button>
                </div>
            </div>
            <p class="text-right text-green-600 font-semibold mt-1">Subtotal: Rp${subtotal.toLocaleString()}</p>
        </div>
        `;
        });

        cartContent.innerHTML = html;
        cartTotal.textContent = 'Rp' + total.toLocaleString();
    }

    // Update badge count
    function updateCartBadge() {
        const badge = document.getElementById('cart-count');
        const totalItems = cartItems.reduce((sum, item) => sum + item.qty, 0);

        if (totalItems > 0) {
            badge.innerText = totalItems;
            badge.classList.remove('hidden');
        } else {
            badge.innerText = '';
            badge.classList.add('hidden');
        }
    }

    // Panggil updateCartBadge saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        updateCartBadge();
    });

    // Menghandle klik ikon cart di navbar
    const cartButton = document.getElementById('cart-button');
    if (cartButton) {
        cartButton.addEventListener('click', () => {
            cartSidebar.classList.toggle('translate-x-full'); // Toggle sidebar saat ikon cart diklik
            renderCart(); // Panggil renderCart saat sidebar dibuka
        });
    }
</script>
</body>

</html>
