
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menambahkan Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('minimarket.manager.feedback.store') }}" method="POST">
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="nama" value="Name" />
                            <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full" value="{{ old('nama') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="jabatan" value="Position" />
                            <x-text-input id="jabatan" type="text" name="jabatan" class="mt-1 block w-full" value="{{ old('jabatan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="keterangan" value="Information" />
                            <x-text-input id="keterangan" type="text" name="keterangan" class="mt-1 block w-full" value="{{ old('keterangan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                        </div>
                        <br>

                        <x-primary-button name="save" value="true">Create Target</x-primary-button>
                        {{-- <x-primary-button name="saveandanother" value="true">Create & Another</x-primary-button> --}}
                        <x-secondary-button tag="a" href="{{ route('minimarket.manager.feedback') }}">Cancel</x-secondary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
