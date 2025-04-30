@section('title', 'Edit Pendaftaran')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></span>
            Edit Pendaftaran</h2>
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
