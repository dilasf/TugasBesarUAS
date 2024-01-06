<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            @foreach($branches as $branch)
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <h4 class="text-lg font-semibold mb-5">{{ $branch->name }}</h4>
                                    @if(isset($productsByBranch[$branch->name]) && count($productsByBranch[$branch->name]) > 0)
                                    <p>Total Product: {{ count($productsByBranch[$branch->name]) }} Product</p>
                                        @php $product = $productsByBranch[$branch->name][0]; @endphp
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Code</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Type</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Unit</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Brand</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Purchase price</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Selling price</th>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                @php $num=1; @endphp
                                                @foreach($productsByBranch[$branch->name] as $barang)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->code_product }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->product_name }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->typesofgoods->name }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->units->name}}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->brand }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->buying_price }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->selling_price }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $barang->stock }}</td>
                                                    </tr>
                                                @endforeach

                                                <!-- Display total purchases and total sales per year -->
                                                <tr> <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td></tr>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        Year {{ $product->created_at->format('Y') }}:
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        Total Purchases: {{ $product->total_purchases }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        Total Sales: {{ $product->total_sales }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        Profit/Loss: {{ $product->profit_loss }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tr>
                                                <tr>
                                                    <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        @php
                                                            $profitLoss = $barang->total_sales - $barang->total_purchases;
                                                            $percentage = ($profitLoss / ($barang->total_purchases ?: 1)) * 100;
                                                        @endphp
                                                        Profit/Loss Percentage: {{ number_format($percentage, 2) }}%
                                                    </th>
                                                </tr>
                                            </tr>
                                        </table>
                                    @else
                                        <p>No products found for this branch.</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
