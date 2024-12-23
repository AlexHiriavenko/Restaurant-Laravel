<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1>Categories</h1>
      <ul>
        {{-- <li class="mb-4"><a href="{{ route('users.roles') }}">manage Users Roles</a></li>
        <li class="mb-4"><a href="{{ route('users.block') }}">manage Blocking Users</a></li> --}}
        <li class="mb-4"><a href="{{ route('dashboard') }}">DashBoard</a></li>
      </ul>
          @if ($categories->isEmpty())
        <p>No categories available.</p>
    @else
        <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->id) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    </div>
  </div>
</x-app-layout>