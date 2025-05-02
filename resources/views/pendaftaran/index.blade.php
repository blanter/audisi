@section('title', 'Peserta Audisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/></svg></span>
            Peserta Audisi</h2>
    </x-slot>

    <div class="pt-1 pb-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6">
                @if(Auth::user()->role != "juri")
                <div class="mb-4">
                    <a href="{{ route('pendaftaran.create') }}" class="fixed-button small-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        +
                    </a>
                </div>
                @endif

                <div class="space-y-4 custom-list">
                    <form method="GET" action="{{ route('pendaftaran.index') }}" class="custom-filter mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cari Nama / Judul</label>
                            <input type="text" name="q" value="{{ request('q') }}" class="border rounded px-3 py-2 w-full" placeholder="Masukkan kata kunci...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Karya</label>
                            <select name="jenis_karya" class="border rounded px-3 py-2 w-full">
                                <option value="">-- Semua --</option>
                                <option value="Stage" {{ request('jenis_karya') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                <option value="Showcase" {{ request('jenis_karya') == 'Showcase' ? 'selected' : '' }}>Showcase</option>
                                <option value="Video" {{ request('jenis_karya') == 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tema</label>
                            <select name="tema" class="border rounded px-3 py-2 w-full">
                                <option value="">-- Semua --</option>
                                <option value="alam" {{ request('tema') == 'alam' ? 'selected' : '' }}>Alam</option>
                                <option value="sosial" {{ request('tema') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="english" {{ request('tema') == 'english' ? 'selected' : '' }}>English</option>
                                <option value="forum" {{ request('tema') == 'forum' ? 'selected' : '' }}>Forum</option>
                                <option value="campuran" {{ request('tema') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                            </select>
                        </div>
                        <div class="self-end">
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                                Filter
                            </button>
                        </div>
                    </form>

                    @forelse ($pendaftarans as $pendaftaran)
                        <div class="bg-white border rounded-xl shadow-sm p-4 flex justify-between items-start status-{{ $pendaftaran->status }}">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <a href="{{ route('pendaftaran.show', $pendaftaran) }}">{{ $pendaftaran->nama_lengkap }}</a>
                                </h3>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <span class="px-2 py-1 rounded-full text-sm bg-blue-100 text-blue-700 custom-label-blue">
                                        {{ $pendaftaran->jenis_karya }}
                                    </span>
                                    <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700 custom-label-yellow">
                                        {{ ucfirst($pendaftaran->tema) }}
                                    </span>
                                </div>
                                <div class="mt-3 text-sm text-gray-500">
                                    📅  {{ $pendaftaran->created_at->format('d M Y') }}
                                </div>
                            </div>
                
                            @auth
                            @if(Auth::user()->role == "admin")
                            <!-- EDIT, HAPUS, CHECK HANYA ADMIN -->
                                <div class="flex flex-col items-end text-sm space-y-1">
                                    <a href="{{ route('pendaftaran.edit', $pendaftaran) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    @if($pendaftaran->status == 0)
                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                    <form action="{{ route('pendaftaran.check', $pendaftaran) }}" method="POST" onsubmit="return confirm('Yakin ingin menandakan selesai?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-500 hover:underline">Check</button>
                                    </form>
                                    @endif
                                    <a href="{{ route('penjurian.show', $pendaftaran) }}" class="text-blue-500 hover:underline">Nilai</a>
                                </div>
                            @endif
                            @if(Auth::user()->role == "user")
                            <!-- CHECK HANYA USER -->
                                <!--<div class="flex flex-col items-end text-sm space-y-1">
                                    @if($pendaftaran->status == 0)
                                    <form action="{{ route('pendaftaran.check', $pendaftaran) }}" method="POST" onsubmit="return confirm('Yakin ingin menandakan selesai?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-500 hover:underline custom-check">Check</button>
                                    </form>
                                    @endif
                                </div>-->
                            @endif
                            @if(Auth::user()->role == "juri")
                            <!-- NILAI HANYA JURI -->
                                <div class="flex flex-col items-end text-sm space-y-1">
                                    <a href="{{ route('penjurian.show', $pendaftaran) }}" class="text-green-500 hover:underline custom-check">Nilai</a>
                                </div>
                            @endif
                            @endauth
                        </div>
                    @empty
                        <p class="text-center text-gray-500 custom-no">Belum ada pendaftar.</p>
                    @endforelse
                </div>

                <div class="mt-6 custom-pagination">
                    {{ $pendaftarans->withQueryString()->links() }}
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
