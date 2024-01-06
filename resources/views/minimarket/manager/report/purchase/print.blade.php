<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Report</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans">
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4 text-center">Purchase Report</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b"> # </th>
                    <th class="py-2 px-4 border-b"> Date </th>
                    <th class="py-2 px-4 border-b"> Initial Stock </th>
                    <th class="py-2 px-4 border-b"> Quantity Purchased </th>
                    <th class="py-2 px-4 border-b"> Total Transactions </th>
                    <th class="py-2 px-4 border-b"> Total Revenue </th>
                </tr>
            </thead>
            <tbody>
                @php $num = 1; @endphp
                @foreach($dailyReports as $report)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $num++ }}</td>
                        <td class="py-2 px-4 border-b">{{ $report->date }}</td>
                        <td class="py-2 px-4 border-b">{{ $report->initialStock }}</td>
                        <td class="py-2 px-4 border-b">{{ $report->quantityPurchased }}</td>
                        <td class="py-2 px-4 border-b">{{ $report->totalTransactions }}</td>
                        <td class="py-2 px-4 border-b">{{ $report->totalRevenue }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="py-2 px-4 border-b"></td>
                    <td class="py-2 px-4 border-b">Total Initial Stock: {{ $totalInitialStock }}</td>
                    <td class="py-2 px-4 border-b">Total Quantity Purchased: {{ $totalQuantityPurchased }}</td>
                    <td class="py-2 px-4 border-b">Total Transactions: {{ $totalTransactions }}</td>
                    <td class="py-2 px-4 border-b">Total Revenue: {{ $totalRevenue }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
