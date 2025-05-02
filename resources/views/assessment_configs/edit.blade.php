@section('title', 'Edit Standar Nilai')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></span>
            {{ __('Edit Standar Nilai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 custom-table">
            <form action="{{ route('standar-nilai.update', $config->id) }}" method="POST" id="configForm" class="p-3">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Jenis Karya</label>
                    <select name="jenis_karya" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Karya --</option>
                        <option value="Stage" {{ $config->jenis_karya == 'Stage' ? 'selected' : '' }}>Stage</option>
                        <option value="Showcase" {{ $config->jenis_karya == 'Showcase' ? 'selected' : '' }}>Showcase</option>
                        <option value="Video" {{ $config->jenis_karya == 'Video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label>Level</label>
                    <select name="level" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="beginner" {{ $config->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ $config->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label>Tipe Karya</label>
                    <input type="text" name="art_type" class="w-full border rounded p-2" value="{{ $config->art_type }}" required>
                    <small class="text-gray-500">Contoh: Menggambar, Album, Kerajinan</small>
                </div>

                <div class="mb-4">
                    <label>Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2" value="{{ $config->title }}" required>
                    <small class="text-gray-500">Contoh: Sketsa, Tehnik, Pencahayaan, Kreatifitas</small>
                </div>

                <div class="mb-4">
                    <label>Type</label>
                    <select name="type" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Type --</option>
                        <option value="radio" {{ $config->type == 'radio' ? 'selected' : '' }}>Radio</option>
                        <option value="checkbox" {{ $config->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                    </select>
                    <small class="text-gray-500">Radio: Single Choice, Checkbox: Multiple Choice</small>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Options</label>
                    <div id="optionsContainer"></div>
                    <button type="button" onclick="addOption()" class="mt-2 bg-gray-200 px-3 py-1 rounded">+ Tambah Opsi</button>
                    <input type="hidden" name="options" id="optionsInput">
                </div>

                <button type="submit" class="small-button bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('standar-nilai.index') }}" class="ml-2 text-gray-600">Batal</a>
            </form>
        </div>
    </div>

    <script>
        let optionCount = 0;
        let optionsData = {!! json_encode(is_string($config->options) ? json_decode($config->options, true) : $config->options, JSON_HEX_TAG) !!};

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

        // Load existing options
        if (Array.isArray(optionsData)) {
            optionsData.forEach(opt => {
                addOption(opt.label, opt.value);
            });
        } else {
            addOption();
        }
    </script>
</x-app-layout>