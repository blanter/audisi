@section('title', 'Edit Pendaftaran')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pendaftaran</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 custom-table">
            <form action="{{ route('pendaftaran.update', $pendaftaran) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Judul Penampilan</label>
                    <input type="text" name="judul" value="{{ old('judul', $pendaftaran->judul) }}" class="w-full border rounded px-3 py-2" required>
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
                    <input type="file" name="storyboard" accept="image/*" class="w-full custom-upload">
                    <small class="text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
                </div>

                <div class="mb-4">
                    <label class="block">Penilaian Guru Baru (opsional)</label>
                    <input type="file" name="penilaian_guru" accept="image/*" class="w-full custom-upload">
                    <small class="text-gray-500">Biarkan kosong jika tidak ingin mengganti.</small>
                </div>

                <div class="mb-4">
                    <label class="block">Perkiraan Durasi</label>
                    <input type="text" name="perkiraan_durasi" value="{{ old('perkiraan_durasi', $pendaftaran->perkiraan_durasi) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">List Prop / Link Drive Powerpoint</label>
                    <textarea name="list_prop" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('list_prop', $pendaftaran->list_prop) }}</textarea>
                </div>

                <div>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('pendaftaran.index') }}" class="ml-2 text-blue-500 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
