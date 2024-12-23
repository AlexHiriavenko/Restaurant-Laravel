<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Orders</h1>
            <h2 class="text-lg text-blue-500 mb-4"><a href="{{ route('dashboard') }}">Back to: Dashboard</a></h2>

            {{-- Сообщение об успехе --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 border border-green-400 rounded px-4 py-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Сообщение об ошибке --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-3 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Форма поиска --}}
            <form method="GET" action="{{ route('orders.search') }}" class="mb-8">
                <div class="flex flex-wrap gap-4">
                    <div class="w-full sm:w-auto flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All</option>
                            @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                                <option value="{{ $status->value }}"
                                    {{ request('status') === $status->value ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-auto flex-1">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="w-full sm:w-auto flex-1">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Search
                    </button>
                </div>
            </form>

            {{-- Список заказов --}}
            @if ($orders->isEmpty())
                <p class="text-gray-600">No orders found.</p>
            @else
                <div class="overflow-x-auto shadow rounded-lg">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Order ID
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Created At
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Client Name
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Client Contact
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-18 min-w-10">
                                    Client Address
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border w-80 min-w-80">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-800 border">{{ $order->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-800 border">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 border">
                                        {{ $order->created_at->format('Y-m-d H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 border">
                                        {{ $order->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 border">
                                        {{ $order->phone }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 border">
                                        {{ $order->address ?? 'самовывоз' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('orders.update-status') }}"
                                            class="space-y-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="flex items-center">
                                                <select name="status"
                                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                                    @foreach (\App\Enums\OrderStatusEnum::cases() as $status)
                                                        <option value="{{ $status->value }}"
                                                            {{ $order->status === $status->value ? 'selected' : '' }}>
                                                            {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                    class="ml-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Пагинация --}}
                <div class="mt-6">
                    {{ $orders->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
