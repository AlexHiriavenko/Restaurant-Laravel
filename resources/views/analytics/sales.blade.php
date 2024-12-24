<x-app-layout>
    <div class="container mx-auto px-4 pb-8 pt-4">
        <h1 class="text-2xl font-bold mb-4">Аналитика продаж</h1>

        <div class="flex items-center justify-center gap-x-12">
            <form method="GET" action="{{ route('analytics.sales') }}" class="bg-gray-100 p-4 rounded-lg shadow mb-6">
                <div class="flex gap-4 mb-4">
                    <div>
                        <label for="start_date" class="block font-medium text-gray-700">Дата начала:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block font-medium text-gray-700">Дата окончания:</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                            class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm">
                    </div>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    Показать
                </button>
            </form>

            <a href="{{ route('analytics.sales.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                class="flex items-center bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition w-36 h-16 text-center">
                <div>
                    <span>Download</span>
                    <span>PDF</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
            </a>
        </div>


        <h2 class="text-xl font-semibold mb-2 text-center">Сумма продаж ИТОГО за период:</h2>
        <p class="text-lg font-bold text-green-600 mb-6 text-center">
            {{ number_format($salesAnalytics['totalSales'], 2) }} грн</p>

        <h2 class="text-xl font-semibold mb-2 text-center">Топ 3 блюда по сумме продаж</h2>
        <table class="table-auto border-collapse border border-gray-300 w-2/3 mx-auto mb-6">
            <thead>
                <tr class="bg-gray-200 max-w-20">
                    <th class="border border-gray-300 px-4 py-2 text-left w-4 min-w-4 max-w-6">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-4 min-w-4 max-w-6">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-20 min-w-20 max-w-20">Название</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-20 min-w-20 max-w-20">Сумма</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesAnalytics['topByRevenue'] as $index => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['dish_id'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($item['total_price'], 2) }} грн
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-semibold mb-2 text-center">Блюда-аутсайдеры по сумме продаж</h2>
        <table class="table-auto border-collapse border border-gray-300 w-2/3 mx-auto mb-4 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Название</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Сумма</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesAnalytics['outsidersByRevenue'] as $index => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['dish_id'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($item['total_price'], 2) }} грн
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-semibold mb-2 text-center">Топ 3 блюда по количеству</h2>
        <table class="table-auto border-collapse border border-gray-300 w-2/3 mx-auto mb-4 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Название</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Количество</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesAnalytics['topByQuantity'] as $index => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['dish_id'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-semibold mb-2 text-center">Блюда-аутсайдеры по количеству</h2>
        <table class="table-auto border-collapse border border-gray-300 w-2/3 mx-auto mb-4 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Название</th>
                    <th class="border border-gray-300 px-4 py-2 text-left w-10 min-w-10">Количество</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesAnalytics['outsidersByQuantity'] as $index => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['dish_id'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
