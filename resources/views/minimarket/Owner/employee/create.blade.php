<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menambah Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('minimarket.owner.employee.store') }}" method="POST">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="email" name="email" class="mt-1 block w-full" value="{{ old('email') }}" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="password" value="Kata Sandi" />
                            <x-text-input id="password" type="password" name="password" class="mt-1 block w-full" value="{{ old('password') }}" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <br>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="position_id" value="Posisi" />
                            <x-select-input id="position_id" name="position_id" class="mt-1 block w-full" required>
                                @foreach($positions as $key => $value)
                                    @if(old('position_id') == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('position_id')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="branch_id" value="Cabang" />
                            <x-select-input id="branch_id" name="branch_id" class="mt-1 block w-full" required>
                                @foreach($branches as $key => $value)
                                    @if(old('branch_id') == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('branch_id')" />
                        </div>

                        <x-primary-button name="save" value="true">Save</x-primary-button>
                        <x-secondary-button tag="a" href="{{ route('minimarket.owner.employee') }}">Cancel</x-secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
