@section('title', 'Detail Pendaftaran')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pendaftaran</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <table class="w-full border border-gray-300 rounded overflow-hidden">
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-2 font-semibold w-1/3">Nama Lengkap</td>
                            <td class="py-2">{{ $pendaftaran->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">Judul Penampilan</td>
                            <td class="py-2">{{ $pendaftaran->judul }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">Jenis Karya</td>
                            <td class="py-2">{{ $pendaftaran->jenis_karya }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">Tema</td>
                            <td class="py-2">{{ ucfirst($pendaftaran->tema) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold">Perkiraan Durasi</td>
                            <td class="py-2">{{ $pendaftaran->perkiraan_durasi }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-semibold align-top">List Prop / Link Drive</td>
                            <td class="py-2"><pre class="bg-gray-100 p-2 rounded whitespace-pre-wrap">{{ $pendaftaran->list_prop }}</pre></td>
                        </tr>
                    </tbody>
                </table>                

                <div class="mb-4">
                    <strong>Storyboard:</strong><br>
                    <img src="{{ asset('storage/' . $pendaftaran->storyboard_path) }}" alt="Storyboard" class="max-w-full h-auto">
                </div>

                <div class="mb-4">
                    <strong>Hasil Penilaian Guru:</strong><br>
                    <img src="{{ asset('storage/' . $pendaftaran->penilaian_guru_path) }}" alt="Penilaian Guru" class="max-w-full h-auto">
                </div>

                <div class="mt-6">
                    <a class="small-button" href="{{ route('pendaftaran.index') }}" class="text-blue-500 hover:underline">Kembali ke daftar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
