<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Pendaftaran Audisi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Jenis Karya</label>
                    <select name="jenis_karya" class="w-full border rounded px-3 py-2" required>
                        <option value="Stage">Stage</option>
                        <option value="Showcase">Showcase</option>
                        <option value="Video">Video</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Pilihan Tema</label>
                    <select name="tema" class="w-full border rounded px-3 py-2" required>
                        <option value="alam">Alam</option>
                        <option value="sosial">Sosial</option>
                        <option value="english">English</option>
                        <option value="forum">Forum</option>
                        <option value="campuran">Campuran</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Upload Storyboard</label>
                    <input type="file" name="storyboard" accept="image/*" class="w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block">Upload Hasil Penilaian Guru</label>
                    <input type="file" name="penilaian_guru" accept="image/*" class="w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block">Perkiraan Durasi</label>
                    <input type="text" name="perkiraan_durasi" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">List Prop</label>
                    <textarea name="list_prop" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
