<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Position -->
            <div class="block mt-4">
                <x-input-label for="position" :value="__('Select Position')" />
                <x-select-input id="position" name="position_id" class="mt-1 block w-full" required>
                    @foreach($positions as $posisi)
                        <option value="{{ $posisi->id }}">{{ $posisi->name }}</option>
                    @endforeach
                </x-select-input>
            </div>

            <!-- Cabang -->
            <div class="block mt-4">
                <x-input-label for="branch" :value="__('Select Branch')" />
                <x-select-input id="branch" name="branch_id" class="mt-1 block w-full" required>
                    @foreach($branches as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                    @endforeach
                </x-select-input>
            </div>
            {{-- <div class="block mt-4">
                <x-input-label for="branch" :value="__('Select Branch')" />

                @if($user && $user->position && $user->position->name === 'Owner')
                    <p class="mt-1 block w-full text-gray-500">Owners do not choose a branch.</p>
                @else
                    <x-select-input id="branch" name="branch_id" class="mt-1 block w-full" required>
                        <option value="" disabled selected>Select Branch</option>
                        @foreach($branches as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                        @endforeach
                    </x-select-input>
                @endif
            </div> --}}


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
