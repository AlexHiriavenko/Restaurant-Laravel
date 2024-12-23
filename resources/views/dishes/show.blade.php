<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Edit Dish</h1>


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

        <!-- Форма редактирования блюда -->
        <form action="{{ route('dishes.update', ['id' => $dish->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}

            <!-- Название -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $dish->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $dish->slug) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Описание -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $dish->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Цена -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" id="price"
                    value="{{ old('price', $dish->price) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Скидка -->
            <div class="mb-4">
                <label for="discount_percent" class="block text-sm font-medium text-gray-700">Discount (%)</label>
                <input type="number" step="1" name="discount_percent" id="discount_percent"
                    value="{{ old('discount_percent', $dish->discount_percent) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('discount_percent')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Категория -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $dish->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Текущее изображение -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Current Image</label>
                @if ($dish->img)
                    <img src="{{ asset('storage/' . $dish->img) }}" alt="Dish Image"
                        class="mt-2 w-48 h-48 object-cover">
                @else
                    <p class="text-gray-500">No image available.</p>
                @endif
            </div>

            <!-- Новое изображение -->
            <div class="mb-4">
                <label for="img" class="block text-sm font-medium text-gray-700">New Image</label>
                <input type="file" name="img" id="img"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    accept="image/*" onchange="previewImage(event)">
                <div id="image-preview" class="mt-2"></div>
                @error('img')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Кнопка -->
            <div class="mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Скрипт для превью изображения -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('mt-2', 'w-48', 'h-48', 'object-cover');
                preview.appendChild(img);
            }
        }
    </script>
</x-app-layout>
