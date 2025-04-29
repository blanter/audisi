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
                    <a href="{{ route('pendaftaran.create') }}" class="fixed-button small-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        +
                    </a>
                </div>

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
                                    <span class="px-2 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                        {{ $pendaftaran->jenis_karya }}
                                    </span>
                                    <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700">
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
                                </div>
                            @endif
                            @if(Auth::user()->role == "user")
                            <!-- CHECK HANYA USER -->
                                <div class="flex flex-col items-end text-sm space-y-1">
                                    @if($pendaftaran->status == 0)
                                    <form action="{{ route('pendaftaran.check', $pendaftaran) }}" method="POST" onsubmit="return confirm('Yakin ingin menandakan selesai?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-500 hover:underline">Check</button>
                                    </form>
                                    @endif
                                </div>
                            @endif
                            @endauth
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada pendaftar.</p>
                    @endforelse
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
