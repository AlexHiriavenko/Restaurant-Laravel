<x-app-layout>
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
    <div class="max-w-7xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Create Dish</h1>

        <form method="POST" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="mt-1 block w-full">
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="mt-1 block w-full">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full">{{ old('description') }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                    class="mt-1 block w-full">
            </div>

            <!-- Discount Percent -->
            <div class="mb-4">
                <label for="discount_percent" class="block text-sm font-medium text-gray-700">Discount Percent</label>
                <input type="number" name="discount_percent" id="discount_percent"
                    value="{{ old('discount_percent') }}" class="mt-1 block w-full">
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Modifiers -->
            <div class="mb-4">
                <label for="modifiers" class="block text-sm font-medium text-gray-700">Modifiers</label>
                <select name="modifiers[]" id="modifiers" multiple class="mt-1 block w-full">
                    @foreach ($modifiers as $modifier)
                        <option value="{{ $modifier->id }}"
                            {{ in_array($modifier->id, old('modifiers', [])) ? 'selected' : '' }}>
                            {{ $modifier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="img" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="img" id="img" class="mt-1 block w-full">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create</button>
            </div>
        </form>
    </div>
</x-app-layout>
