<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('Supervisor.supervisor_stock_barang.create') }}" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="code_purchase" value="Kode Pembelian" />
                            <x-text-input id="code_purchase" type="text" name="code_purchase" class="mt-1 block w-full" value="{{ old('code_purchase')}}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('code_purchase')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="transaction_date" value="Tanggal Pembelian" />
                            <x-text-input id="transaction_date" type="date" name="transaction_date" class="mt-1 block w-full" value="{{ old('transaction_date')}}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('transaction_date')" />
                        </div>

                        <br>
                        <div class="max-w-xl">
                        <x-input-label for="Supplier" value="Pemasok Barang" />
                        <x-select-input id="Supplier" name="supplier_id" class="mt-1 block w-full" required>
                            @foreach($suppliers as $key => $value)
                                @if(old('supplier_id') == $key)
                                    <option value="{{ $key }}" selected>{{$value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value}}</option>
                                @endif
                            @endforeach
                        </x-select-input>
                    </div>

                    <br>
                        <div class="max-w-xl">
                            <x-input-label for="code_product" value="Kode Barang" />
                            <x-text-input id="code_product" type="text" name="code_product" class="mt-1 block w-full" value="{{ old('code_product')}}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('code_product')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="product_name" value="Nama Barang" />
                            <x-text-input id="product_name" type="text" name="product_name" class="mt-1 block w-full" value="{{ old('product_name')}}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="Typesofgood" value="Jenis Barang" />
                            <x-select-input id="Typesofgood" name="type_id" class="mt-1 block w-full" required>
                                @foreach($typesofgoods as $key => $value)
                                    @if(old('type_id') == $key)
                                        <option value="{{ $key }}" selected>{{$value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>

                        <br>

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

                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="brand" value="Merk" />
                            <x-text-input id="brand" type="text" name="brand" class="mt-1 block w-full" value="{{ old('brand') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="stock" value="Jumlah Barang" />
                            <x-text-input id="stock" type="number" name="stock" class="mt-1 block w-full" value="{{ old('stock')}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
