<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul>
                <li class="mb-4 text-blue-500"><a href="{{ route('analytics.sales') }}">Sales Analytics</a></li>
                <li class="mb-4 text-blue-500"><a href="{{ route('analytics.reservations') }}">Reservation Analytics</a>
                </li>
                <li class="mb-4 text-blue-500"><a href="{{ route('dashboard') }}">DashBoard</a></li>
            </ul>
        </div>
    </div>
</x-app-layout>
