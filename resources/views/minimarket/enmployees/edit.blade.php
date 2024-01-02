<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('minimarket.enmployees.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 max-w-xl">
                            <x-input-label for="Name" value="Name" />
                            <x-text-input id="Name" type="text" name="name" class="mt-1 block w-full" value="{{ $user->name }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="block mb-4 max-w-xl">
                            <x-input-label for="position" :value="__('Select Position')" />
                            <x-select-input id="position" name="position_id" class="mt-2 block w-full" required>
                                @foreach($positions as $posisi)
                                    <option value="{{ $posisi->id }}">{{ $posisi->name }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="Email" value="Email" />
                            <x-text-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ $user->email }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="mb-4 max-w-xl">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" type="text" name="password" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <x-secondary-button tag="a" href="{{ route('minimarket.enmployees.create') }}">Cancel</x-secondary-button>
                        <x-primary-button type="submit">Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
