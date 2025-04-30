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
                @if($pendaftaran->jenis_karya == "Showcase")
                <!-- PENILAIAN SHOWCASE -->
                <h3 class="small-heading pt-1 pb-5">Penilaian Showcase</h3>
                <form class="custom-penilaian" method="POST" action="{{ route('penjurian.showcase') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control" onchange="renderWorks()" required="">
                            <option value="">-- Pilih Level --</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="beginner">Beginner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="work">Jenis Karya</label>
                        <select id="work" name="work" class="form-control" onchange="renderAssessment()" required="">
                            <option value="">-- Pilih Karya --</option>
                        </select>
                    </div>
                    <input type="hidden" name="id_peserta" value="1" required="">
                    <input type="hidden" name="id_juri" value="2" required="">
                    <div id="assessment-area"></div>
                    <button class="small-button btn btn-primary mt-4" type="submit">Simpan Penilaian</button>
                </form>
                @endif
                <script>
                const assessmentData = {
                    intermediate: {
                        "Menggambar": [
                            {
                                type: "checkbox",
                                title: "Penilaian",
                                options: [
                                    { label: "Tehnik dan Keterampilan", value: 20 },
                                    { label: "Warna dan Komposisi", value: 20 },
                                    { label: "Originalitas", value: 20 },
                                    { label: "Penyelesaian dan Detail", value: 20 }
                                ]
                            }
                        ],
                        "Ice Cream Stick": [
                            {
                                type: "radio",
                                title: "Sketsa",
                                options: [
                                    { label: "Tidak ada sketsa", value: 0 },
                                    { label: "Ada sketsa", value: 30 }
                                ]
                            },
                            {
                                type: "radio",
                                title: "Dimensi",
                                options: [
                                    { label: "30x30x30 cm", value: 15 },
                                    { label: "30x30x30 cm dan lebih", value: 30 }
                                ]
                            },
                            {
                                type: "radio",
                                title: "Coating",
                                options: [
                                    { label: "Tidak diberi coating", value: 0 },
                                    { label: "Diberi coating", value: 10 }
                                ]
                            },
                            {
                                type: "radio",
                                title: "Hardboard",
                                options: [
                                    { label: "Tidak pakai alas", value: 0 },
                                    { label: "Bukan hardboard", value: 2 },
                                    { label: "Hardboard tidak sesuai", value: 5 },
                                    { label: "Hardboard sesuai", value: 10 }
                                ]
                            },
                            {
                                type: "radio",
                                title: "Stempel Logo",
                                options: [
                                    { label: "Tidak ada makers", value: 0 },
                                    { label: "Ada makers mark", value: 20 }
                                ]
                            }
                        ]
                    },
                    beginner: {
                        "Stick Ice Cream": [
                            {
                                type: "checkbox",
                                title: "Penilaian",
                                options: [
                                    { label: "Sketsa rencana pembuatan", value: 20 },
                                    { label: "Dimensi sesuai standar", value: 20 },
                                    { label: "Diberi coating pelindung", value: 10 },
                                    { label: "Dasar hardboard sesuai", value: 10 },
                                    { label: "Makers mark / stempel", value: 20 },
                                    { label: "Kerumitan karya", value: 20 }
                                ]
                            }
                        ]
                    }
                };
                </script>

                <table class="w-full border border-gray-300 rounded overflow-hidden custom-showtable">
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

<script src="{{asset('/js/script.js')}}" type="text/javascript"></script>
</x-app-layout>
