

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

                    <form method="post" action="{{ route('minimarket.enmployees.index') }}">
                        @csrf
                            <div class="mb-4 max-w-xl">
                                <x-input-label for="Id" value="id" />
                                <x-text-input id="id" type="number" name="id" class="mt-1 block w-full" value="{{ old('code_sale') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('id')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="Name" value="Name" />
                                <x-text-input id="Name" type="text" name="Name" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('Name')" />
                            </div>

                            <select name="position_id" required>
                                <option value="">Pilih posisi</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="Email" value="Email" />
                                <x-text-input id="email" type="text" name="email" min="1" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('Email')" />
                            </div>

                            <div class="mb-4 max-w-xl">
                                <x-input-label for="password" value="Password" />
                                <x-text-input id="password" type="text" name="password" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </x-app-layout>
