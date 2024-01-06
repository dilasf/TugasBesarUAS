
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menambahkan Target Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('minimarket.manager.target.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="max-w-xl">
                            <x-input-label for="bulan" value="Bulan" />
                            <x-text-input id="bulan" type="text" name="bulan" class="mt-1 block w-full" value="{{ old('bulan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('bulan')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="target_penjualan" value="Target Penjualan" />
                            <x-text-input id="target_penjualan" type="number" name="target_penjualan" class="mt-1 block w-full" value="{{ old('target_penjualan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('target_penjualan')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="penjualan_aktual" value="Penjualan Aktual" />
                            <x-text-input id="penjualan_aktual" type="text" class="mt-1 block w-full" value="{{ old('penjualan_aktual') }}" readonly />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="selisih" value="Selisih" />
                            <x-text-input id="selisih" type="number" name="selisih" class="mt-1 block w-full" value="{{ old('selisih') }}" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('selisih')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Create Target</x-primary-button>
                        {{-- <x-primary-button name="saveandanother" value="true">Create & Another</x-primary-button> --}}
                        <x-secondary-button tag="a" href="{{ route('minimarket.manager.target') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
