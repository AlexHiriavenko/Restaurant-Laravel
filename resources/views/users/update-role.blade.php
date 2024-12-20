<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1>Manage Users and Roles</h1>

      {{-- Форма поиска --}}
      <form action="{{ route('users.update-role') }}" method="GET" class="mb-6">
        <div class="mb-3">
          <label for="email" class="form-label">Search by Email</label>
          <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $email) }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
      </form>

      {{-- Список пользователей --}}
      @if ($users->isEmpty())
        <p>No users found.</p>
      @else
        <form action="{{ route('users.upr') }}" method="POST">
          @csrf
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Current Role</th>
                  <th>New Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                      @foreach ($roles as $role)
                        <p>{{ $role->id }}:{{ $role->name }}</p> <!-- Для вывода id роли -->
                      @endforeach
                        <select name="role_id" class="form-select">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                      <button type="submit" name="user_id" value="{{ $user->id }}" class="btn btn-success">
                        Update Role
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
      @endif
    </div>
  </div>
</x-app-layout>
