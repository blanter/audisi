<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pendaftaran</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <div class="mb-4">
                    <strong>Nama Lengkap:</strong> {{ $pendaftaran->nama_lengkap }}
                </div>

                <div class="mb-4">
                    <strong>Jenis Karya:</strong> {{ $pendaftaran->jenis_karya }}
                </div>

                <div class="mb-4">
                    <strong>Tema:</strong> {{ ucfirst($pendaftaran->tema) }}
                </div>

                <div class="mb-4">
                    <strong>Perkiraan Durasi:</strong> {{ $pendaftaran->perkiraan_durasi }}
                </div>

                <div class="mb-4">
                    <strong>List Prop:</strong><br>
                    <pre class="bg-gray-100 p-2 rounded">{{ $pendaftaran->list_prop }}</pre>
                </div>

                <div class="mb-4">
                    <strong>Storyboard:</strong><br>
                    <img src="{{ asset('storage/' . $pendaftaran->storyboard_path) }}" alt="Storyboard" class="max-w-full h-auto">
                </div>

                <div class="mb-4">
                    <strong>Hasil Penilaian Guru:</strong><br>
                    <img src="{{ asset('storage/' . $pendaftaran->penilaian_guru_path) }}" alt="Penilaian Guru" class="max-w-full h-auto">
                </div>

                <div class="mt-6">
                    <a href="{{ route('pendaftaran.index') }}" class="text-blue-500 hover:underline">Kembali ke daftar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
