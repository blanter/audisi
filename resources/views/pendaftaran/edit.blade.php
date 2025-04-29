<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pendaftaran</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('pendaftaran.update', $pendaftaran) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Jenis Karya</label>
                    <select name="jenis_karya" class="w-full border rounded px-3 py-2" required>
                        @foreach (['Stage', 'Showcase', 'Video'] as $jenis)
                            <option value="{{ $jenis }}" @selected($pendaftaran->jenis_karya === $jenis)>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Pilihan Tema</label>
                    <select name="tema" class="w-full border rounded px-3 py-2" required>
                        @foreach (['alam', 'sosial', 'english', 'forum', 'campuran'] as $tema)
                            <option value="{{ $tema }}" @selected($pendaftaran->tema === $tema)>{{ ucfirst($tema) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Storyboard Baru (opsional)</label>
                    <input type="file" name="storyboard" accept="image/*" class="w-full">
                    <small class="text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
                </div>

                <div class="mb-4">
                    <label class="block">Penilaian Guru Baru (opsional)</label>
                    <input type="file" name="penilaian_g_
