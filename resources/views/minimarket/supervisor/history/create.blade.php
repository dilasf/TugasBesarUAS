
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inmployees') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('minimarket.inmployees.index') }}">
                        @csrf
                            <div class="mb-4 max-w-xl">
                                <x-input-label for="code_barang" value="Code Barang" />
                                <x-text-input id="code_barang" type="text" name="code_barang" class="mt-1 block w-full" value="{{ old('code_sale') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('code_barang')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="id_product" value="Id Product" />
                                <x-text-input id="id_product" type="text" name="id_product" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('id_product')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="type_pembayaran" value="Type Pembayaran" />
                                <x-text-input id="type_pembayaran" type="number" name="type_pembayaran" min="1" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('type_pembayaran')" />
                            </div>

            <script>

                var salePriceInput = document.getElementById('sale_price');
                var quantityInput = document.getElementById('quantity');
                var taxAmountInput = document.getElementById('tax_amount');
                var totalHargaInput = document.getElementById('total_price');
                var totalHargaSetelahDiskonInput = document.getElementById('total_price_after_discount');
                var totalPaymentInput = document.getElementById('total_payment');
                var changeAmountInput = document.getElementById('change_amount');
                </script>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </x-app-layout>
