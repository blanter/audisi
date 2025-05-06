@section('title', 'Edit Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M361 215l-144 144c-9 9-24 9-33 0l-72-72c-9-9-9-24 0-33s24-9 33 0l55 55 127-127c9-9 24-9 33 0s9 24 0 33z"/></svg>
            </span>
            Edit Task
        </h2>
    </x-slot>

    <div class="pt-1 pb-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 mt-5 max-w-lg mx-auto custom-table">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium">Nama Panitia</label>
                        <input type="text" name="nama_panitia" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('nama_panitia', $task->nama_panitia) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Detail Singkat</label>
                        <input type="text" name="nama_task" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('nama_task', $task->nama_task) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('penanggung_jawab', $task->penanggung_jawab) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Anggota (Pisahkan dengan koma)</label>
                        <input type="text" name="anggota" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('anggota', implode(', ', $task->anggota ?? [])) }}"
                               placeholder="contoh: Budi, Sari, Dara">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Deskripsi Task</label>
                        <div id="deskripsi-wrapper">
                            @php
                                $oldDeskripsi = old('deskripsi', $task->deskripsi ?? [['judul' => '', 'status' => 'progress']]);
                            @endphp
                            @foreach($oldDeskripsi as $i => $item)
                            <div class="flex gap-2 mb-2 deskripsi-item">
                                <input type="text" name="deskripsi[{{ $i }}][judul]" class="w-full border rounded px-3 py-2 mt-1"
                                       value="{{ $item['judul'] }}" placeholder="Nama Tugas" required>
                                <select name="deskripsi[{{ $i }}][status]" class="hidden">
                                    <option value="{{ $item['status'] }}">{{ $item['status'] }}</option>
                                </select>
                                <button type="button" onclick="removeDeskripsi(this)" class="text-red-500 hover:text-red-700 text-sm px-2">Hapus</button>
                            </div>
                        @endforeach                        
                        </div>
                        <button type="button" onclick="addDeskripsi()" class="mt-2 bg-gray-300 text-sm px-2 py-1 rounded">+ Tambah Tugas</button>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <script>
                let index = {{ count($oldDeskripsi) }};
                function addDeskripsi() {
                    const wrapper = document.getElementById('deskripsi-wrapper');
                    const html = `
                    <div class="flex gap-2 mb-2 deskripsi-item">
                        <input type="text" name="deskripsi[${index}][judul]" class="w-full border rounded px-3 py-2 mt-1"
                            placeholder="Nama Tugas" required>
                        <select name="deskripsi[${index}][status]" class="hidden">
                            <option value="progress">Progress</option>
                        </select>
                        <button type="button" onclick="removeDeskripsi(this)" class="text-red-500 hover:text-red-700 text-sm px-2">Hapus</button>
                    </div>`;
                    wrapper.insertAdjacentHTML('beforeend', html);
                    index++;
                }
                function removeDeskripsi(button) {
                    const item = button.closest('.deskripsi-item');
                    if (item) item.remove();
                }
            </script>
        </div>
    </div>
</x-app-layout>
