<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Transaksi Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total Transactions</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @php $num=1; @endphp
                                            @foreach($dailyReports as $report)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $report->date }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $report->totalTransactions }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $report->totalRevenue }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
