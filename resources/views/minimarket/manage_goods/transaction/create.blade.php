<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('minimarket.manage_goods.transaction.store') }}">
                        @csrf

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="transaction_date" value="Tanggal Transaksi" />
                            <x-text-input id="transaction_date" type="datetime-local" name="transaction_date" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="supplier_name" value="Pemasok" />
                            <x-text-input id="supplier_name" type="text" name="supplier_name" class="mt-1 block w-full" value="{{ old('supplier_name') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('supplier_name')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="code_purchase" value="Kode Pembelian" />
                            <x-text-input id="code_purchase" type="text" name="code_purchase" class="mt-1 block w-full" value="{{ old('code_purchase') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('code_purchase')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="code_product" value="Kode Produk" />
                            <x-text-input id="code_product" type="text" name="code_product" class="mt-1 block w-full" value="{{ old('code_product') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('code_product')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="product_name" value="Nama Produk" />
                            <x-text-input id="product_name" type="text" name="product_name" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="Typesofgood" value="Jenis Barang" />
                            <x-select-input id="Typesofgood" name="type_id" class="mt-1 block w-full" required>
                                @foreach($typesOfGoods as $key => $value)
                                    @if(old('type_id') == $key)
                                        <option value="{{ $key }}" selected>{{$value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="Unit" value="Satuan Barang" />
                            <x-select-input id="Unit" name="unit_id" class="mt-1 block w-full" required>
                                @foreach($units as $key => $value)
                                    @if(old('unit_id') == $key)
                                        <option value="{{ $key }}" selected>{{$value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="brand" value="Merk" />
                            <x-text-input id="brand" type="text" name="brand" class="mt-1 block w-full" value="{{ old('brand') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="buying_price" value="Harga Beli" />
                            <x-text-input id="buying_price" type="number" name="buying_price" class="mt-1 block w-full" value="{{ old('buying_price')}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('buying_price')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="quantity" value="Jumlah Barang" />
                            <x-text-input id="quantity" type="number" name="quantity" class="mt-1 block w-full" value="{{ old('quantity')}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="total_amount" value="Total Harga" />
                            <x-text-input id="total_amount" type="number" name="total_amount" class="mt-1 block w-full" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="payment_method_id" value="Metode Pembayaran" />
                            <x-select-input id="payment_method_id" name="payment_method_id" class="mt-1 block w-full" required>
                                @foreach($paymentMethods as $key => $value)
                                    @if(old('payment_method_id') == $key)
                                        <option value="{{ $key }}" selected>{{$value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>
                        <br>

                        <div>
                            <x-primary-button type="submit" name="save" value="true">Buy</x-primary-button>
                        </div>

                    </form>

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

                    <!-- ... Total Amount ... -->
                    <script>
                       document.addEventListener('DOMContentLoaded', function () {
                        function updateTotalAmount() {
                            var buyingPrice = parseFloat(document.getElementById('buying_price').value) || 0;
                            var quantity = parseInt(document.getElementById('quantity').value) || 0;
                            var totalAmount = buyingPrice * quantity;

                            document.getElementById('total_amount').value = totalAmount.toFixed(2);
                            updateLabel('total_amount', 'Harga Total: ' + totalAmount.toFixed(2)); // Tambahkan pemanggilan ini
                        }

                        document.getElementById('buying_price').addEventListener('input', updateTotalAmount);
                        document.getElementById('quantity').addEventListener('input', updateTotalAmount);

                        // Fungsi untuk memperbarui label
                        function updateLabel(inputId, labelText) {
                            var label = document.querySelector('label[for="' + inputId + '"]');
                            label.textContent = labelText;
                        }

                        updateTotalAmount();
                    });

                    </script>
                    <!-- ... End Total Amount ... -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
