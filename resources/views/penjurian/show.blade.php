@section('title', 'Penilaian Peserta Audisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></span>
            Penilaian Peserta Audisi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6">
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
                            <td class="py-2"><pre class="bg-gray-100 p-2 rounded whitespace-pre-wrap">{!! Str::of(e($pendaftaran->list_prop))->replaceMatches(
                                '/(https?:\/\/[^\s]+)/',
                                fn($match) => '<a href="' . $match[0] . '" class="text-blue-600 underline" target="_blank" rel="noopener noreferrer">' . $match[0] . '</a>'
                            )->replace("\n", '<br>') !!}
                            </pre></td>
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
