<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Аналитика бронирований</h1>

        <form method="GET" action="{{ route('analytics.reservations') }}" class="bg-gray-100 p-4 rounded-lg shadow mb-6">
            <div class="flex gap-4 mb-4">
                <div>
                    <label for="start_date" class="block font-medium text-gray-700">Дата начала:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                        class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full">
                </div>
                <div>
                    <label for="end_date" class="block font-medium text-gray-700">Дата окончания:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                        class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm w-full">
                </div>
            </div>
            <button type="submit"
                class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Показать
            </button>
        </form>

        <h2 class="text-xl font-semibold mb-2 text-center">Количество бронирований по дням недели</h2>
        <table class="table-auto w-2/3 mx-auto border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">День недели</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Количество</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Процент</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fullAnalytics['byWeekday'] as $weekday => $data)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $weekday }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['count'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['percentage'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-semibold mb-2 text-center"></h2>
        <table class="table-auto w-2/3 mx-auto border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">Время Бронирования</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Количество</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Процент</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fullAnalytics['byStartTime'] as $startTime => $data)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $startTime }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['count'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $data['percentage'] }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
