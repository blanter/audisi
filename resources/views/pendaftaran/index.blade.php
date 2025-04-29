@section('title', 'Pendaftar Audisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pendaftar Audisi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6">
                <div class="mb-4">
                    <a href="{{ route('pendaftaran.create') }}" class="small-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        + Pendaftaran
                    </a>
                </div>

                <table class="w-full table-auto">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Nama Lengkap</th>
                            <th class="px-4 py-2">Jenis Karya</th>
                            <th class="px-4 py-2">Tema</th>
                            @auth
                            <th class="px-4 py-2">Aksi</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftarans as $pendaftaran)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $pendaftaran->nama_lengkap }}</td>
                                <td class="px-4 py-2">{{ $pendaftaran->jenis_karya }}</td>
                                <td class="px-4 py-2">{{ ucfirst($pendaftaran->tema) }}</td>
                                @auth
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('pendaftaran.show', $pendaftaran) }}" class="text-blue-500 hover:underline">Lihat</a>
                                    <a href="{{ route('pendaftaran.edit', $pendaftaran) }}" class="text-yellow-500 hover:underline">Edit</a>
                                
                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>                                
                                @endauth                       
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center">Belum ada pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
