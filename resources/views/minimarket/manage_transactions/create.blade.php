<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kasir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('minimarket.manage_transactions.store') }}">
                        @csrf

                        <input type="hidden" name="branch_id" value="{{ $branch_id }}" />

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="paymentstatus" value="Metode Pembayaran" />
                            <x-select-input id="paymentstatus" name="payment_status_id" class="mt-1 block w-full" required>
                                @foreach($paymentstatus as $key => $value)
                                @if(old('payment_status_id') == $key)
                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('payment_status_id')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="code_sale" value="Kode Penjualan" />
                                <x-text-input id="code_sale" type="text" name="code_sale" class="mt-1 block w-full" value="{{ old('code_sale') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('code_sale')" />
                            </div>


                            <div class="mb-4 max-w-xl">
                                <x-input-label for="transaction_date" value="Tanggal Transaksi" />
                                <x-text-input id="transaction_date" type="datetime-local" name="transaction_date" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="product_name" value="Nama Produk" />
                                <x-text-input id="product_name" type="text" name="product_name" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="sale_price" value="Harga Jual" />
                                    <x-text-input id="sale_price" type="number" name="sale_price" class="mt-1 block w-full" readonly/>
                                <x-input-error class="mt-2" :messages="$errors->get('sale_price')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="quantity" value="Jumlah Barang" />
                                <x-text-input id="quantity" type="number" name="quantity" min="1" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="tax_amount" value="Jumlah Pajak" />
                                <x-text-input id="tax_amount" type="number" name="tax_amount" min="0" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('tax_amount')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="total_price" value="Total Harga" />
                                <x-text-input id="total_price" type="number" name="total_price" class="mt-1 block w-full" readonly />
                                <x-input-error class="mt-2" :messages="$errors->get('total_price')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="discount_name" value="Nama Diskon" />
                                <x-text-input id="discount_name" type="text" name="discount_name" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('discount_name')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="total_price_after_discount" value="Total Harga Setelah Diskon" />
                                <x-text-input id="total_price_after_discount" type="number" name="total_price_after_discount" class="mt-1 block w-full" readonly />
                                <x-input-error class="mt-2" :messages="$errors->get('total_price_after_discount')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="payment" value="Metode Pembayaran" />
                                <x-select-input id="payment" name="payment_id" class="mt-1 block w-full" required>
                                    @foreach($payments as $key => $value)
                                    @if(old('payment_id') == $key)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('payment_id')" />
                                </div>

                                <div class="mb-4 max-w-xl">
                                    <x-input-label for="total_payment" value="Uang yang Diterima" />
                                    <x-text-input id="total_payment" type="number" name="total_payment" class="mt-1 block w-full" value="{{ old('total_payment') }}" />
                                    <x-input-error class="mt-2" :messages="$errors->get('total_payment')" />
                                </div>

                                <div class="mb-4 max-w-xl">
                                    <x-input-label for="change_amount" value="Uang Kembali" />
                                    <x-text-input id="change_amount" type="number" name="change_amount" class="mt-1 block w-full" readonly />
                                    <x-input-error class="mt-2" :messages="$errors->get('change_amount')" />
                                </div>

                                <div>
                                    <x-primary-button type="button" name="save" value="true">Buy</x-primary-button>
                                </div>

                    <!-- ... End Automatic Time ... -->
                    <script>
                        function autoFillDateTime() {

                            var dateTimeInput = document.getElementById('transaction_date');
                            var currentDate = new Date();

                            var year = currentDate.getFullYear();
                            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                            var day = ('0' + currentDate.getDate()).slice(-2);
                            var hours = ('0' + currentDate.getHours()).slice(-2);
                            var minutes = ('0' + currentDate.getMinutes()).slice(-2);

                            var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;

                            dateTimeInput.value = formattedDateTime;
                        }
                    </script>
                     <!-- ... End Automatic Time ... -->

        <!-- ... Transaction ... -->
        <script>
            //inisialisasi
            var salePriceInput = document.getElementById('sale_price');
            var quantityInput = document.getElementById('quantity');
            var taxAmountInput = document.getElementById('tax_amount');
            var discountNameInput = document.getElementById('discount_name');
            var totalHargaInput = document.getElementById('total_price');
            var totalHargaSetelahDiskonInput = document.getElementById('total_price_after_discount');
            var totalPaymentInput = document.getElementById('total_payment');
            var changeAmountInput = document.getElementById('change_amount');
            var productNameInput = document.getElementById('product_name');

            // Menghitung dan menampilkan total-total
            salePriceInput.addEventListener('input', updateTotalHarga);
            quantityInput.addEventListener('input', updateTotalHarga);
            taxAmountInput.addEventListener('input', updateTotalHarga);

            discountNameInput.addEventListener('input', function () {
                updateTotalHargaSetelahDiskon();
            });

            totalPaymentInput.addEventListener('input', updateChangeAmount);

            // pengecekan harga dan nama produk
            function checkProduct() {
                var productName = productNameInput.value.trim();

                fetch('/get-product/' + productName)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error:', data.error);
                        } else {
                            var selling_price = parseFloat(data.selling_price) || 0;
                        salePriceInput.value = selling_price.toFixed(2);
                        updateSalePriceLabel();
                            updateTotalHarga();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function updateSalePriceLabel() {
                var salePrice = parseFloat(salePriceInput.value) || 0;
                var salePriceLabel = document.querySelector('label[for="sale_price"]');
                salePriceLabel.textContent = 'Harga Jual: ' + salePrice.toFixed(2);
            }
            updateSalePriceLabel();

            // Menghitung dan menampilkan Total Harga
            function updateTotalHarga() {
                var salePrice = parseFloat(salePriceInput.value) || 0;
                var quantity = parseFloat(quantityInput.value) || 0;
                var taxAmount = parseFloat(taxAmountInput.value) || 0;
                var totalHarga = salePrice * quantity + taxAmount;
                totalHargaInput.value = totalHarga.toFixed(2);
                updateLabel('total_price', 'Total Harga: ' + totalHarga.toFixed(2));
                updateTotalHargaSetelahDiskon();
            }

            // Menghitung dan menampilkan Total Harga Setelah Diskon saat input berubah
            function updateTotalHargaSetelahDiskon() {
                var totalHarga = parseFloat(totalHargaInput.value) || 0;
                var discountName = discountNameInput.value.trim();

                // Mendapatkan nilai diskon
                fetch('/get-discount/' + discountName)
                    .then(response => response.json())
                    .then(data => {
                        var diskonPercentage = data.discount_percent || 0;
                        if (diskonPercentage > 1) {
                            diskonPercentage = diskonPercentage / 100;
                        }

                        // Cek syarat pembelian minimal 50000
                        if (totalHarga > 49000) {
                            var totalHargaSetelahDiskon = totalHarga - (totalHarga * diskonPercentage);
                            totalHargaSetelahDiskon = Math.max(totalHargaSetelahDiskon, 0);
                            totalHargaSetelahDiskonInput.value = totalHargaSetelahDiskon.toFixed(2);
                            updateLabel('total_price_after_discount', 'Total Harga Setelah Diskon: ' + totalHargaSetelahDiskon.toFixed(2));
                        } else {
                            totalHargaSetelahDiskonInput.value = totalHarga.toFixed(2);
                            updateLabel('total_price_after_discount', 'Total Harga Setelah Diskon: ' + totalHarga.toFixed(2));
                        }

                        updateChangeAmount();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Menghitung dan menampilkan Uang Kembali saat input berubah
            function updateChangeAmount() {
                var totalHargaSetelahDiskon = parseFloat(totalHargaSetelahDiskonInput.value) || 0;
                var totalPayment = parseFloat(totalPaymentInput.value) || 0;
                var changeAmount = totalPayment - totalHargaSetelahDiskon;
                changeAmountInput.value = changeAmount.toFixed(2);
                updateLabel('change_amount', 'Uang Kembali: ' + changeAmount.toFixed(2));
            }

            function updateLabel(labelId, labelText) {
                var label = document.querySelector('label[for="' + labelId + '"]');
                label.textContent = labelText;
            }

            // UpdateTotalHarga
            document.addEventListener('DOMContentLoaded', function () {
                updateTotalHarga();
            });

            // pengecekan nama dan harga produk saat nama produk berubah
            productNameInput.addEventListener('change', function () {
                checkProduct();
            });

        </script>
        <!-- ... End Transaction ... -->

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
