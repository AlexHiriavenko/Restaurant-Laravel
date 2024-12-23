<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Сообщение об ошибке --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 border border-red-400 rounded px-4 py-3 mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                <li class="mb-4 text-blue-500"><a href="{{ route('users.update-role') }}">Update User Role</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('orders.search') }}">Update Order Status</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('dishes.search') }}">Edit Dishes</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('dishes.create') }}">Add New Dish</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('analytics.sales') }}">Sales Analytics</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('analytics.reservations') }}">Booking Analytics</a>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>
