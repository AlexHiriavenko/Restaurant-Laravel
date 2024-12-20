<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                <li class="mb-4"><a href="{{ route('users') }}">manage Users</a></li>
                {{-- <li class="mb-4"><a href="{{ route('dishes') }}">manage Dishes</a></li>
                <li class="mb-4"><a href="{{ route('orders') }}">manage Orders</a></li>
                <li class="mb-4"><a href="{{ route('analytics') }}">manage Orders</a></li> --}}
            </ul>
        </div>
    </div>
</x-app-layout>
