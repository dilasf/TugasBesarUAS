<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Feedback') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray100">
                    <form method="post" action="{{ route('minimarket.manager.feedback.update', ['id' => $user->id]) }}" enctype="multipart/form-data" class="mt-6 space-y6">
                        @csrf
                        @method('PATCH')

                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name', $user->name )}}" readonly required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="positions" value="Posisi" />
                            <x-select-input id="positions" name="position_id" class="mt-1 block w-full" required disabled>
                                @foreach($userPositions as $key => $value)
                                    @if(old('position_id', $user->position_id) == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </x-select-input>
                        </div>
                        <br>

                        <div class="max-w-xl">
                            <x-input-label for="feedback" value="Umpan Balik" />
                            <x-text-input id="feedback" type="text" name="feedback" class="mt-1 block w-full" value="{{ old('feedback', $user->feedback )}}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('feedback')" />
                        </div>
                        <br>


                        <div class="mt-4">
                            <x-secondary-button tag="a" href="{{ route('minimarket.manager.feedback') }}">Cancel</x-secondary-button>
                            <x-primary-button type="submit">Update</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
   </x-app-layout>
