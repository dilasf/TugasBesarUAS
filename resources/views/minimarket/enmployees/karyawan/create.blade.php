<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('minimarket.enmployees.karyawan.store') }}">
                        @csrf
                        <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- <div class="block mb-4 max-w-xl">
                            <x-input-label for="position" :value="__('Select Position')" />
                            <x-select-input id="position" name="position_name" class="mt-2 block w-full" required>
                                @foreach($positions as $posisi)
                                    <option value="{{ $posisi->name }}">{{ $posisi->name }}</option>
                                @endforeach
                            </x-select-input>
                        </div> --}}

                        <div class="max-w-xl">
                            <x-input-label for="Position" value="Pilih Posisi" />
                            <x-select-input id="Position" name="position_id" class="mt-1 block w-full" required>
                                @foreach( $positions as $key => $value)
                                    @if(old('position_id') == $key)
                                        <option value="{{ $key }}" selected>{{$value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>
                        

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="email" name="email" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" type="text" name="password" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-primary-button type="submit" name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
