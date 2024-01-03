<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
{{-- 
                    <x-primary-button tag="a" href="{{route('minimarket.manage_goods.transaction.create')}}">Purchase of New Products</x-primary-button> --}}
                    <br>

                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                          <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Position</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Password </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($users as $employee)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $employee->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $employee->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $employee->positions->name}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $employee->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Password Tersembunyi</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
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
    </div>
</x-app-layout>
