<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l448 0c53 0 96-43 96-96l0-320c0-53-43-96-96-96L96 0zM64 96c0-17.7 14.3-32 32-32l448 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32L64 96zm159.8 80a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM96 309.3c0 14.7 11.9 26.7 26.7 26.7l56.1 0c8-34.1 32.8-61.7 65.2-73.6c-7.5-4.1-16.2-6.4-25.3-6.4l-69.3 0C119.9 256 96 279.9 96 309.3zM461.2 336l56.1 0c14.7 0 26.7-11.9 26.7-26.7c0-29.5-23.9-53.3-53.3-53.3l-69.3 0c-9.2 0-17.8 2.3-25.3 6.4c32.4 11.9 57.2 39.5 65.2 73.6zM372 289c-3.9-.7-7.9-1-12-1l-80 0c-4.1 0-8.1 .3-12 1c-26 4.4-47.3 22.7-55.9 47c-2.7 7.5-4.1 15.6-4.1 24c0 13.3 10.7 24 24 24l176 0c13.3 0 24-10.7 24-24c0-8.4-1.4-16.5-4.1-24c-8.6-24.3-29.9-42.6-55.9-47zM512 176a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM320 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128z"/></svg></span>
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
                                        @if($user->id != 1)
                                        <select data-user-id="{{ $user->id }}" class="role-select border rounded p-1 w-full">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="juri" {{ $user->role === 'juri' ? 'selected' : '' }}>Juri</option>
                                        </select>
                                        @endif
                                    </td>
                                    <td class="p-2 border text-center">
                                        @if($user->id != 1)
                                        <form action="{{ route('destroyuser', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                        @endif
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
