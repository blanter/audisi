<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white rounded shadow">
                @if(session('status'))
                    <div class="mb-4 text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            
                <!-- Search Form (server-side) -->
                <form method="GET" action="{{ route('adminuser') }}" class="mb-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." 
                        class="w-full sm:w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                </form>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border text-sm sm:text-base custom-table" id="userTable">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-2 border">Name</th>
                                <th class="p-2 border">Email</th>
                                <th class="p-2 border">Role</th>
                                <th class="p-2 border text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="p-2 border">{{ $user->name }}</td>
                                    <td class="p-2 border">{{ $user->email }}</td>
                                    <td class="p-2 border" style="min-width:120px">
                                        <select data-user-id="{{ $user->id }}" class="role-select border rounded p-1 w-full">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="juri" {{ $user->role === 'juri' ? 'selected' : '' }}>Juri</option>
                                        </select>
                                    </td>
                                    <td class="p-2 border text-center">
                                        <form action="{{ route('destroyuser', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script src="{{asset('/js/jquery.js')}}"></script>
            <script>
                $('.role-select').on('change', function () {
                    var userId = $(this).data('user-id');
                    var selectedRole = $(this).val();
            
                    $.ajax({
                        url: '/adminuser/' + userId + '/editrole',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            role: selectedRole
                        },
                        success: function (response) {
                            alert(response.message);
                        },
                        error: function (xhr) {
                            alert('Error: ' + xhr.responseJSON.message);
                        }
                    });
                });
            </script>
        </div>
    </div>
</x-app-layout>
