<x-app-layout>
    {{-- Сообщение об ошибке --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-3 mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                <li class="mb-4 text-blue-500"><a href="{{ route('orders.search') }}">Update Orders Status</a></li>
                {{-- <li class="mb-4"><a href="{{ route('users.block') }}">manage Blocking Users</a></li> --}}
                <li class="mb-4 text-blue-500"><a href="{{ route('dashboard') }}">DashBoard</a></li>
            </ul>
        </div>
    </div>
</x-app-layout>
