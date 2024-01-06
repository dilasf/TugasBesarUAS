<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mt-2">
                        <x-primary-button tag="a" href="{{ route('minimarket.owner.employee.create') }}">
                            {{ __('New Employee') }}
                        </x-primary-button>
                    </div>
                        <div class="-m-1.5 overflow-x-auto">
                            @foreach($branches as $branch)
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <h4 class="text-lg font-semibold mb-5">{{ $branch->name }}</h4>
                                @if(isset($usersByBranch[$branch->name]))
                                    <p>Pegawai: {{ count($usersByBranch[$branch->name]) }}</p>
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Position</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Password</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Action</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Last Login </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @php $num=1; @endphp
                                            @foreach($usersByBranch[$branch->name] as $user)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        @if (isset($user->positions))
                                                            {{ is_array($user->positions) ? $user->positions[0]->name : $user->positions->name }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Password Tersembunyi</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                            <x-primary-button tag="a" href="{{ route('minimarket.owner.employee.edit', ['id' => $user->id]) }}"> Edit </x-primary-button>
                                                            <x-danger-button
                                                                x-data=""
                                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                                                x-on:click="$dispatch('set-action', '{{ route('minimarket.owner.employee.destroy', $user->id) }}')"
                                                            >{{ __('Delete') }}</x-danger-button>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                        @if($user->last_login_at)
                                                            {{ $user->last_login_at }}
                                                        @else
                                                            Belum pernah login
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No users found for this branch.</p>
                                @endif
                                </div>
                            @endforeach
                    </div>
                </div>
                 <!-- MODAL -->
                 <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" x-bind:action="action" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Apakah anda yakin akan menghapus data?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Setelah proses dilakukan, maka data tidak dapat dikembalikan.') }}
                        </p>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ml-3">
                                {{ __('Delete Data') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
              <!-- End OF Content -->
            </div>
        </div>
    </div>
</x-app-layout>
