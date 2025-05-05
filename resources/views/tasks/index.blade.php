@section('title', 'Task List Panitia')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></span>
            Task List Panitia</h2>
    </x-slot>

    <div class="pt-1 pb-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-4">
                @if(Auth::user()->role == "admin")
                <div class="mb-4">
                    <a href="{{ route('tasks.create') }}" class="fixed-button small-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        +
                    </a>
                </div>
                @endif
            
                <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 custom-filter custom-f0">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari apapun..."
                        class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring">
                </form>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 relative custom-taskbox">
                    @foreach ($tasks as $task)
                        <div class="bg-white border rounded-xl p-4 transition custom-boxtask">
                            <div class="relative custom-btn-elipsis">
                                <!-- Tombol titik 3 untuk dropdown -->
                                <button onclick="toggleDropdown({{ $task->id }})"
                                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none custom-elipsis">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                                </button>
                            
                                <!-- Dropdown menu untuk Edit dan Delete -->
                                <div id="dropdown-{{ $task->id }}"
                                    class="hidden absolute right-2 top-8 bg-white border rounded shadow-md z-10 w-28">
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-100 text-gray-700">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus task ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-red-100 text-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Task Details -->
                            <h2 class="text-lg font-semibold mb-1">Panitia {{ $task->nama_panitia }}</h2>
                            <p class="text-sm text-gray-500 mb-2">Detail: {{ $task->nama_task }}</p>
                            <p class="text-sm mb-2">Penanggung Jawab: {{ $task->penanggung_jawab }}</p>
                            <!-- Anggota Task -->
                            <div class="mb-2">
                                <p class="text-sm mb-2">Anggota:
                                    @foreach ($task->anggota ?? [] as $anggota)
                                        <span>{{ $anggota }}</span>
                                    @endforeach
                                </p>
                            </div>
                            
                            <!-- Deskripsi Task -->
                            <ul class="list-disc list-inside text-sm text-gray-700">
                                @foreach ($task->deskripsi ?? [] as $i => $desc)
                                    <li class="flex items-center gap-2 custom-task-check custom-check-{{$desc['status']}}">
                                        <input type="checkbox" data-task-id="{{ $task->id }}" data-index="{{ $i }}"
                                            @checked($desc['status'] === 'done')
                                            onchange="updateDeskripsiStatus({{ $task->id }}, {{ $i }}, this.checked)" id="check-{{ $task->id }}{{ $i }}">
                                        <label for="check-{{ $task->id }}{{ $i }}">{{ $desc['judul'] }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <script src="{{asset('/js/jquery.js')}}"></script>
            <script>
                // Update status saat checkbox dicentang
                function updateDeskripsiStatus(taskId, index, isChecked) {
                    fetch(`/tasks/${taskId}/deskripsi/${index}/status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ status: isChecked ? 'done' : 'progress' })
                    }).then(res => res.json())
                    .then(data => console.log(data.message));
                }
            
                // Fungsi toggle dropdown
                function toggleDropdown(id) {
                    const dropdown = document.getElementById('dropdown-' + id);
                    dropdown.classList.toggle('hidden');
                }
            
                // Menutup dropdown jika klik di luar
                document.addEventListener('click', function(e) {
                    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                        if (!dropdown.contains(e.target) && !dropdown.previousElementSibling.contains(e.target)) {
                            dropdown.classList.add('hidden');
                        }
                    });
                });
            </script>
        </div>
    </div>
</x-app-layout>
