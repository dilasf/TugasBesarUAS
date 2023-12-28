<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Membuat Diskon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('minimarket.manage_transactions.discount.store') }}" method="POST">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="discount_name" value="Nama Diskon" />
                            <x-text-input id="discount_name" type="text" name="discount_name" class="mt-1 block w-full" value="{{ old('discount_name') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('discount_name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="discount_percent" value="Persentase Diskon (%)" />
                            <x-text-input id="discount_percent" type="number" name="discount_percent" class="mt-1 block w-full" value="{{ old('discount_percent') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('discount_percent')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="start_date" value="Tanggal Dimulai" />
                            <x-text-input id="start_date" type="date" name="start_date" class="mt-1 block w-full" value="{{ old('start_date') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="end_date" value="Tenggat" />
                            <x-text-input id="end_date" type="date" name="end_date" class="mt-1 block w-full" value="{{ old('end_date') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Create Discount</x-primary-button>
                        {{-- <x-primary-button name="saveandanother" value="true">Create & Another</x-primary-button> --}}
                        <x-secondary-button tag="a" href="{{ route('minimarket.manage_transactions.discount') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
