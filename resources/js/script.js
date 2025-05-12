let cartItems = JSON.parse(localStorage.getItem('cart') || '[]'); 
const cartSidebar = document.getElementById('cartSidebar');
const cartContent = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');

// Fungsi untuk menampilkan/menyembunyikan sidebar keranjang
window.toggleCart = function () {
    cartSidebar.classList.toggle('translate-x-full');
    renderCart();  // Pastikan keranjang dirender ulang ketika sidebar dibuka
};

// Fungsi untuk menambah item ke keranjang
window.addToCart = function (item) {
    const existing = cartItems.find(i => i.id === item.id);
    if (existing) {
        existing.qty += 1; // Jika item sudah ada, tambahkan jumlahnya
    } else {
        cartItems.push({ ...item, qty: 1 }); // Jika belum ada, tambahkan item baru
    }

    // Simpan ke localStorage
    localStorage.setItem('cart', JSON.stringify(cartItems));

    renderCart();  // Update tampilan keranjang
    updateCartBadge();  // Perbarui jumlah di badge
    cartSidebar.classList.remove('translate-x-full'); // Tutup sidebar setelah menambah
};

// Fungsi untuk menaikkan jumlah item
window.increaseQty = function (index) {
    cartItems[index].qty += 1;
    localStorage.setItem('cart', JSON.stringify(cartItems)); // Simpan perubahan ke localStorage
    renderCart();
    updateCartBadge();
};

// Fungsi untuk menurunkan jumlah item
window.decreaseQty = function (index) {
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

