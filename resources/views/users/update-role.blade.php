<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage Users Roles</h1>
      <h2 class="text-lg text-green-500 mb-4"><a href="{{ route('users') }}">Back to: Manage Users</a></h2>
      {{-- Сообшение об успехе --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 rounded px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
      @endif
      {{-- Форма поиска --}}
      <form action="{{ route('users.update-role') }}" method="GET" class="mb-6">
        <div class="mb-4">
          <label for="searchText" class="block text-sm font-medium text-gray-700 mb-2">Search by Email</label>
          <input
            type="text"
            id="searchText"
            name="searchText"
            value="{{ old('searchText', $searchText) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
          >
        </div>
        <button
          type="submit"
          class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          Search
        </button>
      </form>

      {{-- Список пользователей --}}
      @if ($users->isEmpty())
        <p class="text-gray-600">No users found.</p>
      @else
        <div class="overflow-x-auto shadow rounded-lg">
          <table class="min-w-full bg-white border border-gray-300 rounded-md">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Name</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Email</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Current Role</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">New Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-4 py-2 text-sm text-gray-800">{{ $user->name }}</td>
                  <td class="px-4 py-2 text-sm text-gray-800">{{ $user->email }}</td>
                  <td class="px-4 py-2 text-sm text-gray-800">{{ $user->role->name }}</td>
                  <td class="px-4 py-2">
                    <form action="{{ route('users.update-role.post') }}" method="POST" class="space-y-2">
                      @csrf
                      <div class="flex justify-between">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select
                          name="role_id"
                          class="w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                          @endforeach
                        </select>
                        <button
                          type="submit"
                          class="px-3 py-2 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                          Update Role
                        </button>
                      </div>

                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>
