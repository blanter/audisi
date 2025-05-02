@section('title', 'Tambah Standar Nilai')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg></span>
            {{ __('Tambah Standar Nilai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 custom-table">
            <form action="{{ route('standar-nilai.store') }}" method="POST" id="configForm" class="p-3">
                @csrf

                <div class="mb-4">
                    <label>Jenis Karya</label>
                    <select name="jenis_karya" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Karya --</option>
                        <option value="Stage">Stage</option>
                        <option value="Showcase">Showcase</option>
                        <option value="Video">Video</option>
                    </select>
                </div>
        
                <div class="mb-4">
                    <label>Level</label>
                    <select name="level" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                    </select>
                </div>
        
                <div class="mb-4">
                    <label>Tipe Karya</label>
                    <input type="text" name="art_type" class="w-full border rounded p-2" required>
                    <small class="text-gray-500">Contoh: Menggambar, Album, Kerajinan</small>
                </div>
        
                <div class="mb-4">
                    <label>Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2" required>
                    <small class="text-gray-500">Contoh: Sketsa, Tehnik, Pencahayaan, Kreatifitas</small>
                </div>
        
                <div class="mb-4">
                    <label>Type</label>
                    <select name="type" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Type --</option>
                        <option value="radio">Radio</option>
                        <option value="checkbox">Checkbox</option>
                    </select>
                    <small class="text-gray-500">Radio: Single Choice, Checkbox: Multiple Choice</small>
                </div>
        
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Options</label>
                    <div id="optionsContainer"></div>
                    <button type="button" onclick="addOption()" class="mt-2 bg-gray-200 px-3 py-1 rounded">+ Tambah Opsi</button>
                    <input type="hidden" name="options" id="optionsInput">
                </div>
        
                <button type="submit" class="small-button bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('standar-nilai.index') }}" class="ml-2 text-gray-600">Batal</a>
            </form>
        </div>
    </div>

    <script>
        let optionCount = 0;
    
        function addOption(label = '', value = '') {
            const container = document.getElementById('optionsContainer');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mb-2');
            div.innerHTML = `
                <input type="text" placeholder="Aspek Penilaian" class="border p-2 w-1/2 option-label" value="${label}">
                <input type="number" placeholder="Poin" class="border p-2 w-1/4 option-value" value="${value}">
                <button type="button" onclick="removeOption(this)" class="text-red-500">Hapus</button>
            `;
            container.appendChild(div);
        }
    
        function removeOption(button) {
            button.parentElement.remove();
        }
    
        document.getElementById('configForm').addEventListener('submit', function (e) {
            const labels = document.querySelectorAll('.option-label');
            const values = document.querySelectorAll('.option-value');
            let options = [];
    
            for (let i = 0; i < labels.length; i++) {
                const label = labels[i].value.trim();
                const value = values[i].value.trim();
                if (label && value) {
                    options.push({ label, value: Number(value) });
                }
            }
    
            document.getElementById('optionsInput').value = JSON.stringify(options);
        });
    
        // Default: Add 1 empty option field
        addOption();
    </script>
</x-app-layout>
