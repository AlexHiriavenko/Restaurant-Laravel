<x-app-layout>
    {{-- Сообщение об ошибке --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-3 mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Dishes</h1>

            <!-- Форма поиска -->
            <form method="GET" action="{{ route('dishes.search') }}" class="mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Поле для поиска -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Выбор количества на страницу -->
                    <div>
                        <label for="per_page" class="block text-sm font-medium text-gray-700">Items Per Page</label>
                        <select name="per_page" id="per_page"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ([5, 10, 15, 20] as $option)
                                <option value="{{ $option }}"
                                    {{ request('per_page', 10) == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Кнопка отправки -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- Таблица блюд -->
            @if ($dishes->isEmpty())
                <p class="text-gray-600">No dishes found.</p>
            @else
                <div class="overflow-x-auto shadow rounded-lg">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dishes as $dish)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-800">{{ $dish->id }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        <a href="{{ route('dishes.show', $dish->id) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $dish->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-800">
                                        {{ $dish->category->name ?? 'No category' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Пагинация -->
                <div class="mt-6">
                    {{ $dishes->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
