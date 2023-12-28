<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray100">
                    <form method="post" action="{{ route('minimarket.manage_goods.update', $barang->id) }}" enctype="multipart/form-data" class="mt-6 space-y6">
                        @csrf
                        @method('PATCH')


                        <div class="max-w-xl">
                            <x-input-label for="code_product" value="Kode Barang" />
                            <x-text-input id="code_product" type="text" name="code_product" class="mt-1 block w-full" value="{{ old('code_product', $barang->code_product)}}"
                               readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('code_product')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="product_name" value="Nama Barang" />
                            <x-text-input id="product_name" type="text" name="product_name" class="mt-1 block w-full" value="{{ old('product_name', $barang->product_name)}}"
                                readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('product_name')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="Typesofgood" value="Jenis Barang" />
                            <x-select-input id="Typesofgood" name="type_id" class="mt-1 block w-full" required>
                                @foreach($typesofgoods as $key => $value)
                                    @if(old('type_id', $barang->type_id) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>

                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="Unit" value="Satuan Barang" />
                            <x-select-input id="Unit" name="unit_id" class="mt-1 block w-full" required>
                                @foreach($units as $key => $value)
                                    <option value="{{ $key }}" {{ $barang->unit_id == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="brand" value="Merk" />
                            <x-text-input id="brand" type="text" name="brand" class="mt-1 block w-full" value="{{ old('brand', $barang->brand )}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="buying_price" value="Harga Beli" />
                            <x-text-input id="buying_price" type="number" name="buying_price" class="mt-1 block w-full" value="{{ old('buying_price', $barang->buying_price)}}" readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('buying_price')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="selling_price" value="Harga Jual" />
                            <x-text-input id="selling_price" type="number" name="selling_price" class="mt-1 block w-full" value="{{ old('selling_price', $barang->selling_price)}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('selling_price')" />
                        </div>
                        <br>
                        <div class="max-w-xl">
                            <x-input-label for="stock" value="Jumlah Barang" />
                            <x-text-input id="stock" type="number" name="stock" class="mt-1 block w-full" value="{{ old('stock', $barang->stock)}}" readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>
                        <br>

                        <x-secondary-button tag="a" href="{{ route('minimarket.manage_goods') }}">Cancel</x-secondary-button>
                        <x-primary-button value="true">Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </x-app-layout>
