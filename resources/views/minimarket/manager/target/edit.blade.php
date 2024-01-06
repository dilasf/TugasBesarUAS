<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Target') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('minimarket.manager.target.update', $targetSales->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="max-w-xl">
                            <x-input-label for="bulan" value="Bulan" />
                            <x-text-input id="bulan" type="text" name="bulan" class="mt-1 block w-full" value="{{ old('bulan', $targetSales->bulan) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('bulan')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="target_penjualan" value="Target Penjualan" />
                            <x-text-input id="target_penjualan" type="number" name="target_penjualan" class="mt-1 block w-full" value="{{ old('target_penjualan',$targetSales->target_penjualan) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('target_penjualan')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="penjualan_aktual" value="Penjualan Aktual" />
                            <x-text-input id="penjualan_aktual" type="number" name="penjualan_aktual" class="mt-1 block w-full" value="{{ old('penjualan_aktual') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('penjualan_aktual')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="selisih" value="Selisih" />
                            <x-text-input id="selisih" type="number" name="selisih" class="mt-1 block w-full" value="{{ old('selisih', $targetSales->selisih) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('selisih')" />
                        </div>

                        <x-primary-button value="true">Update Target</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('minimarket.manager.target') }}">Cancel</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('target_penjualan').addEventListener('input', function () {
            var targetPenjualan = parseFloat(document.getElementById('target_penjualan').value) || 0;
            var penjualanAktual = parseFloat(document.getElementById('penjualan_aktual').value) || 0;

            var selisih = targetPenjualan - penjualanAktual;
            document.getElementById('selisih').value = selisih.toFixed(2);
        });
    </script>
</x-app-layout>
