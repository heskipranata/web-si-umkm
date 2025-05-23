@include('partials.header')

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-700 mb-4">Pembayaran</h2>

    <!-- Container Keranjang -->
    <div id="checkout-items" class="space-y-4 border-b pb-4"></div>
    <div class="text-right font-bold text-xl text-green-700 mt-4 mb-6">
        Total: <span id="checkout-total">Rp0</span>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('transaction.store') }}">
        @csrf
        <input type="hidden" name="cart_items" id="input-cart">

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700">Nama Pemesan</label>
            <input type="text" name="customer_name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Meja</label>
            <div class="grid grid-cols-5 gap-2">
                @for ($i = 1; $i <= 15; $i++)
                    <label class="flex items-center space-x-1">
                        <input type="radio" name="table_number" value="{{ $i }}" required>
                        <span>Meja {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

                <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Pesan Tambahan</label>
            <textarea name="optional_message" rows="2" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
            <div class="flex space-x-6">
                <label class="flex items-center space-x-1">
                    <input type="radio" name="payment_method" value="Cash" checked onchange="togglePaymentNote()">
                    <span>Cash</span>
                </label>
                <label class="flex items-center space-x-1">
                    <input type="radio" name="payment_method" value="Transfer" onchange="togglePaymentNote()">
                    <span>Transfer Bank</span>
                </label>
            </div>
            <div id="payment-note" class="mt-2 text-sm text-gray-600">
                Silakan bayar di kasir setelah konfirmasi.
            </div>
        </div>




        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700">
            Konfirmasi dan Bayar
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartData = JSON.parse(localStorage.getItem('cart') || '[]');
        const container = document.getElementById('checkout-items');
        const totalField = document.getElementById('checkout-total');
        const inputCart = document.getElementById('input-cart');

        let html = '';
        let total = 0;

        cartData.forEach(item => {
            const subtotal = item.price * item.qty;
            total += subtotal;

            html += `
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <p class="font-semibold">${item.name} x${item.qty}</p>
                    <p class="text-sm text-gray-500">Rp${item.price.toLocaleString()} x ${item.qty}</p>
                </div>
                <div class="text-green-600 font-bold">Rp${subtotal.toLocaleString()}</div>
            </div>
        `;
        });

        container.innerHTML = html;
        totalField.textContent = 'Rp' + total.toLocaleString();
        inputCart.value = JSON.stringify(cartData);
    });

    function togglePaymentNote() {
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const note = document.getElementById('payment-note');
        if (method === 'Cash') {
            note.textContent = 'Silakan bayar di kasir setelah konfirmasi.';
        } else {
            note.innerHTML = 'Transfer ke rekening <span class="font-semibold text-blue-600">BCA 1234567890</span> atau <span class="font-semibold text-blue-600">BRI 4547221279</span> a.n. <span class="font-medium">Warung Makan Cabadas jo</span>.';
        }
    }
</script>
