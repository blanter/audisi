@section('title', 'Tambah Task')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg></span>
            Tambah Task</h2>
    </x-slot>

    <div class="pt-1 pb-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-4 mt-5 max-w-lg mx-auto custom-table">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
            
                    <div class="mb-4">
                        <label class="block font-medium">Nama Panitia</label>
                        <input type="text" name="nama_panitia" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('nama_panitia') }}" required>
                    </div>
            
                    <div class="mb-4">
                        <label class="block font-medium">Detail Singkat</label>
                        <input type="text" name="nama_task" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('nama_task') }}" required>
                    </div>
            
                    <div class="mb-4">
                        <label class="block font-medium">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('penanggung_jawab') }}" required>
                    </div>
            
                    <div class="mb-4">
                        <label class="block font-medium">Anggota (Pisahkan dengan koma)</label>
                        <input type="text" name="anggota" class="w-full border rounded px-3 py-2 mt-1"
                               value="{{ old('anggota') }}" placeholder="contoh: Budi, Sari, Dara">
                    </div>
            
                    <div class="mb-4">
                        <label class="block font-medium mb-2">Deskripsi Task</label>
                        <div id="deskripsi-wrapper">
                            @php
                                $oldDeskripsi = old('deskripsi', [['judul' => '', 'status' => 'pending']]);
                            @endphp
                            @foreach($oldDeskripsi as $i => $item)
                                <div class="flex gap-2 mb-2">
                                    <input type="text" name="deskripsi[{{ $i }}][judul]" class="w-full border rounded px-3 py-2 mt-1"
                                           value="{{ $item['judul'] }}" placeholder="Nama Tugas" required>
                                        <select name="deskripsi[{{ $i }}][status]" class="hidden">
                                            <option value="progress" @selected($item['status'] === 'progress')>Progress</option>
                                        </select>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addDeskripsi()" class="mt-2 bg-gray-300 text-sm px-2 py-1 rounded">+ Tambah Deskripsi</button>
                    </div>
            
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            
            <script>
                let index = {{ count($oldDeskripsi) }};
            
                function addDeskripsi() {
                    const wrapper = document.getElementById('deskripsi-wrapper');
                    const html = `
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="deskripsi[${index}][judul]" class="w-full border rounded px-3 py-2 mt-1"
                               placeholder="Nama Tugas" required>
                        <select name="deskripsi[${index}][status]" class="hidden">
                            <option value="progress">Progress</option>
                        </select>
                    </div>`;
                    wrapper.insertAdjacentHTML('beforeend', html);
                    index++;
                }
            </script>
        </div>
    </div>
</x-app-layout>