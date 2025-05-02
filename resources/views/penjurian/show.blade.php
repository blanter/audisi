@section('title', 'Penilaian Peserta Audisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></span>
            Penilaian Peserta Audisi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white p-6">
                @if(Auth::user()->role != "user")
                <!-- FORM PENILAIAN -->
                <h3 class="small-heading pt-1 pb-5">Penilaian <b>{{$pendaftaran->jenis_karya}}</b></h3>
                <form id="form-penilaian" class="custom-penilaian" method="POST" action="{{ route('penjurian.penilaian', $pendaftaran) }}">
                    @csrf
                
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control" onchange="renderWorks()" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="beginner">Beginner</option>
                        </select>
                    </div>
                
                    <div class="mb-3">
                        <label for="work">Tipe Karya</label>
                        <select id="work" name="work" class="form-control" onchange="renderAssessment()" required>
                            <option value="">-- Pilih Karya --</option>
                        </select>
                    </div>
                
                    <input type="hidden" name="id_peserta" value="{{ $pendaftaran->id }}" required>
                    <input type="hidden" name="id_juri" value="{{ Auth::user()->id }}" required>
                    <div id="assessment-area"></div>
                    <input type="hidden" name="penilaian" id="penilaian-hidden">
                
                    <button id="submit-btn" type="button" class="small-button btn btn-primary mt-4">
                        Simpan Penilaian
                    </button>
                </form>    
                @endif

                <!-- SCRIPT DATA PENILAIAN -->
                <script>
                    const assessmentData = {!! $assessmentData !!};
                </script>

                <!-- HISTORY -->
                <h3 class="small-heading pt-3 pb-5">History Penilaian</h3>
                <div class="custom-list">
                @forelse ($penilaians as $penilaian)
                <div class="bg-white border rounded-xl shadow-sm p-4 flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            @php
                                $juri = $users->firstWhere('id', $penilaian->id_juri);
                            @endphp
                            Juri: {{ $juri->name ?? 'Tidak diketahui' }}
                        </h3>
            
                        @php
                            $items = is_array($penilaian->penilaian) 
                                ? $penilaian->penilaian 
                                : json_decode($penilaian->penilaian, true);
                        @endphp
            
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700 custom-label-blue">
                                {{ ucfirst($penilaian->level) }}
                            </span>
                            <span class="px-2 py-1 rounded-full text-sm bg-green-100 text-green-700 custom-label-blue">
                                {{ ucfirst($penilaian->tipe) }}
                            </span>
                        </div>
                        @if (!empty($items))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach($items as $item)
                                    <span class="px-2 py-1 rounded-full text-sm bg-blue-100 text-blue-700 custom-label-yellow">
                                        {{ $item['label'] ?? 'N/A' }} ({{ $item['score'] ?? 0 }})
                                    </span>
                                @endforeach
                            </div>
                        @endif
            
                        <div class="mt-3 text-sm text-gray-500">
                            📅 {{ $penilaian->created_at->format('d M Y') }}
                        </div>
                    </div>
            
                    <div class="flex flex-col items-end text-sm space-y-1">
                        <a class="text-green-500 hover:underline custom-check">
                            <b>{{ $penilaian->total_score }}</b>
                        </a>
                        @if(Auth::user()->role == "admin")
                        <form action="{{ route('penjurian.destroy', $penilaian) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-center text-gray-500 custom-no">Belum ada penilaian.</p>
                @endforelse
                    <div class="mt-6 custom-pagination">
                        {{ $penilaians->withQueryString()->links() }}
                    </div>
                </div>

                <!-- DETAIL PESERTA -->
                <table class="w-full border border-gray-300 rounded overflow-hidden custom-showtable">
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-2 font-semibold w-1/3">Nama Lengkap</td>
                            <td class="py-2"><b>{{ $pendaftaran->nama_lengkap }}</b></td>
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
                            <td class="py-2 font-semibold w-1/3"><b>Nilai Sementara</b></td>
                            <td class="py-2"><b class="custom-label">{{$datanilai}}</b></td>
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

<script src="{{asset('/js/script.js')}}" type="text/javascript"></script>
</x-app-layout>
