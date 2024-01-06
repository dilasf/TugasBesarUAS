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
                                <x-input-label for="brand" value="Nama Produk" />
                                <x-text-input id="brand" type="text" name="brand" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="sale_price" value="Harga Jual" id="labelSalePrice" />
                                <x-text-input id="sale_price" type="number" name="sale_price" class="mt-1 block w-full" readonly />
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

                            {{-- <div class="mb-4 max-w-xl">
                                <x-input-label for="discount_name" value="Nama Diskon" />
                                <x-text-input id="discount_name" type="text" name="discount_name" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('discount_name')" />
                            </div> --}}

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="discount_id" value="Diskon" />
                                <x-select-input id="discount_id" name="discount_id" class="mt-1 block w-full" required>
                                    <option value="" selected>Tidak ada diskon</option>
                                    @foreach($discounts as $id => $discount)
                                        <option value="{{ $id }}">{{ $discount['discount_name'] }} - {{ $discount['discount_percent'] }}%</option>
                                    @endforeach
                                </x-select-input>
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
                        document.addEventListener("DOMContentLoaded", function () {
                            var brandInput = document.getElementById('brand');
                            var salePriceInput = document.getElementById('sale_price');
                            var quantityInput = document.getElementById('quantity');
                            var taxAmountInput = document.getElementById('tax_amount');
                            var totalPriceInput = document.getElementById('total_price');
                            var totalAfterDiscountInput = document.getElementById('total_price_after_discount');
                            var labelTotalPrice = document.querySelector('[for="total_price"]');
                            var labelSalePrice = document.querySelector('[for="sale_price"]');
                            var discountNameInput = document.getElementById('discount_id');
                            var receivedAmountInput = document.getElementById('total_payment');
                            var changeAmountInput = document.getElementById('change_amount');


                            if (!brandInput || !salePriceInput || !quantityInput || !taxAmountInput || !totalPriceInput || !totalAfterDiscountInput || !labelTotalPrice || !labelSalePrice || !discountNameInput || !totalAfterDiscountInput || !receivedAmountInput || !changeAmountInput) {
                                console.error('Elemen tidak ditemukan. Pastikan semua elemen yang diperlukan ada dalam dokumen HTML.');
                                return;
                            }

                            function calculateTotalPrice() {
                                var salePrice = parseFloat(salePriceInput.value) || 0;
                                var quantity = parseInt(quantityInput.value) || 0;
                                var taxAmount = parseFloat(taxAmountInput.value) || 0;

                                var totalPrice = salePrice * quantity + taxAmount;
                                totalPriceInput.value = totalPrice.toFixed(2);

                                if (labelTotalPrice) {
                                    labelTotalPrice.textContent = 'Total Harga ' + totalPrice.toFixed(1);
                                } else {
                                    console.error('Elemen label untuk total harga tidak ditemukan.');
                                }

                                // Trigger discount calculation after setting the initial total price
                                calculateTotalPriceAfterDiscount();
                            }

                            function calculateTotalPriceAfterBrandDiscount() {
                                var brandName = brandInput.value;
                                var apiUrl = '/get-brand-price/' + brandName;

                                fetch(apiUrl)
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log('Received data:', data);
                                        if (data && typeof data.selling_price === 'string') {
                                            var numericSellingPrice = parseFloat(data.selling_price);

                                            if (!isNaN(numericSellingPrice)) {
                                                salePriceInput.value = numericSellingPrice;
                                                labelSalePrice.textContent = 'Harga Jual ' + numericSellingPrice.toFixed(2); // Updated to display '.00'
                                                calculateTotalPrice();
                                                // Calculate after setting sale price
                                                calculateTotalPriceAfterDiscount();
                                            } else {
                                                console.error('Gagal mengonversi selling_price menjadi angka:', data.selling_price);
                                            }
                                        } else {
                                            console.error('Data tidak sesuai dengan format yang diharapkan:', data);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Terjadi kesalahan saat mengambil harga dari server:', error);
                                        // Handle the error gracefully here
                                    });
                            }

                            function calculateTotalPriceAfterDiscount() {
                                var discountOption = discountNameInput.options[discountNameInput.selectedIndex];

                                if (discountOption) {
                                    if (discountOption.value === "") {
                                        // If "Tidak ada diskon" is selected, set discount to 0%
                                        var discountPercent = 0;
                                    } else {
                                        // Extracting discount percent from the selected option
                                        var discountInfo = discountOption.text.split(' - ');
                                        var discountPercent = parseFloat(discountInfo[1].replace('%', '')) || 0;
                                    }

                                    var salePrice = parseFloat(salePriceInput.value) || 0;
                                    var quantity = parseInt(quantityInput.value) || 0;
                                    var taxAmount = parseFloat(taxAmountInput.value) || 0;

                                    // Calculate total price
                                    var totalPrice = salePrice * quantity + taxAmount;

                                    // Check if total price is above 24000 for applying discount
                                    if (totalPrice > 24000) {
                                        var discountAmount = (discountPercent / 100) * totalPrice;
                                        var totalAfterDiscount = totalPrice - discountAmount;

                                        // Display the result in your input field
                                        totalAfterDiscountInput.value = totalAfterDiscount.toFixed(2);
                                    } else {
                                        // If total price is 24000 or below, no discount is applied
                                        totalAfterDiscountInput.value = totalPrice.toFixed(2);
                                    }

                                    // Update the label for consistency
                                    var labelTotalAfterDiscount = document.querySelector('[for="total_price_after_discount"]');
                                    if (labelTotalAfterDiscount) {
                                        labelTotalAfterDiscount.textContent = 'Total Harga Setelah Diskon ' + totalAfterDiscountInput.value;
                                    } else {
                                        console.error('Elemen label untuk total harga setelah diskon tidak ditemukan.');
                                    }
                                } else {
                                    console.error('Discount option is not selected.');
                                }
                                calculateChangeAmount();
                            }

                            function calculateChangeAmount() {
                                console.log('calculateChangeAmount');
                                var totalAfterDiscount = parseFloat(totalAfterDiscountInput.value) || 0;
                                var receivedAmount = parseFloat(receivedAmountInput.value) || 0;
                                var changeAmount = receivedAmount - totalAfterDiscount;

                                changeAmountInput.value = changeAmount.toFixed(2);

                                var labelChangeAmount = document.querySelector('[for="change_amount"]');
                                if (labelChangeAmount) {
                                    labelChangeAmount.textContent = 'Uang Kembali: ' + changeAmountInput.value;
                                } else {
                                    console.error('Elemen label untuk uang kembali tidak ditemukan.');
                                }
                                console.log('Change Amount:', changeAmount);
}

                            quantityInput.addEventListener('input', calculateTotalPrice);
                            taxAmountInput.addEventListener('input', calculateTotalPrice);
                            receivedAmountInput.addEventListener('input', calculateChangeAmount);

                            // Call calculateTotalPriceAfterBrandDiscount on page load
                            calculateTotalPriceAfterBrandDiscount();

                            brandInput.addEventListener('change', function () {
                                calculateTotalPriceAfterBrandDiscount();
                                calculateTotalPriceAfterDiscount();
                                calculateChangeAmount();
                            });

                            // Trigger calculation when the discount dropdown changes
                            discountNameInput.addEventListener('change', function () {
                                calculateTotalPriceAfterDiscount();
                            });
                        });
                    </script>


                     <!-- ... End Transaction ... -->

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
