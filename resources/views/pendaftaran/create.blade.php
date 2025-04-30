@section('title', 'Form Pendaftaran Audisi')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg></span>
                Form Pendaftaran Audisi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 custom-table">

            <div class="custom-informasi">
                Halo players, penting sebelum kalian mengisi formulir pendaftaran audisi, ada baiknya kalian membaca <a class="small-button" onclick="toggleModal()" href="javascript:;">Ketentuan Bentuk Karya</a> isinya merupakan informasi terkait kewajiban standar setiap fase maupun tema audisi yang dipilih. Terdapat juga panduan pengisian form pendaftaran audisi.
            </div>

            <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6">
                @csrf

                <div class="mb-4">
                    <label class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Judul Penampilan</label>
                    <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Jenis Karya</label>
                    <select name="jenis_karya" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled selected>Pilih Jenis Karya</option>
                        <option value="Stage">Stage</option>
                        <option value="Showcase">Showcase</option>
                        <option value="Video">Video</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block">Pilihan Tema</label>
                    <select name="tema" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled selected>Pilih Tema</option>
                        <option value="alam">Alam</option>
                        <option value="sosial">Sosial</option>
                        <option value="english">English</option>
                        <option value="forum">Forum</option>
                        <option value="campuran">Campuran</option>
                    </select>
                </div>                

                <div class="mb-4">
                    <label class="block">Upload Storyboard</label>
                    <input type="file" name="storyboard" accept="image/*" class="w-full custom-upload" required>
                </div>

                <div class="mb-4">
                    <label class="block">Upload Hasil Penilaian Guru</label>
                    <input type="file" name="penilaian_guru" accept="image/*" class="w-full custom-upload" required>
                </div>

                <div class="mb-4">
                    <label class="block">Perkiraan Durasi</label>
                    <input type="text" name="perkiraan_durasi" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">List Prop / Link Drive Powerpoint</label>
                    <textarea name="list_prop" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
   
    <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 relative custom-modal-box">
            <button onclick="toggleModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-lg font-bold">&times;</button>
            
            <h2 class="text-xl font-semibold mb-4">Ketentuan & Informasi</h2>
            <div class="text-gray-700 custom-body-box">
<b>Alam Sosial</b>
<ul>
<li>Untuk semua fase boleh menampilkan dalam bentuk stage. Yaitu presentasi menggunakan power point dan punya buku makalahnya. Pada saat presentasi, boleh memilih sebagian topik yang ingin diperdalam dan dipresentasikan. Dengan syarat, standar naskah presentasinya sudah dikonfirmasi dan di approve oleh guru alam sosial sesuai fase.</li>
<li>Untuk fase scholar 4 - 6 tidak diperkenankan </li>
<li>Untuk fase scholar 4 - 9 wajib mengambil materi dari ide belajar yang dibuat oleh pak guru Irwan. </li>
<li>Untuk fase scholar 7 - 9, tidak diperkenankan menggabungkan bahasa Inggris dengan alam sosial kecuali yang lolos dari tes cara baca dan vocabulary dari guru english di fasenya. </li>
<li>Untuk fase scholar 10 - 12, diperbolehkan menggabung alam sosial dengan bahasa Inggris, dengan syarat konsultasi dengan guru bahasa Inggris di fasenya. </li>
<li>Untuk fase scholar 10 - 12, diperbolehkan untuk mengambil topik alam sosial untuk karya Production di luar alam sosial pilihan untuk levelnya, bahkan di luar alam sosial dan diperbolehkan untuk mandiri selama proses belajar. Tetapi harus tes presentasi dulu bersama wali kelasnya sebelum audisi. </li>
<li>Untuk semua fase boleh menampilan alam sosial dalam bentuk video, tetapi wajib hafal (minimal per sub topik), tidak boleh ada membaca / tidak hafal selama di shoot.</li>
</ul>
<b>Bahasa Inggris</b>
<ul>
<li>Untuk semua fase boleh menampilkan dalam bentuk stage. </li>
<li>Untuk fase scholar 4 - 6: story telling, conversation: drama / operet (kembali ke backbone pak guru Irwan). </li>
<li>Untuk fase scholar 7 - 12: conversation, speech and article presentation (kembali ke standar alumni pertama belajar bahasa Inggris dengan pak guru Aris) </li>
<li>Untuk semua fase boleh menampilkan dalam bentuk video. Dengan isian bahasa Inggrisnya seperti ketentuan pada penampilan stage. </li>
<li>Untuk fase scholar 4 - 6, tidak diperkenankan menggabungkan bahasa Inggris dengan karya forum, dalam bentuk apapun. Kecuali Videography Forumnya.</li>
<li>Untuk fase scholar 7 - 12, diperbolehkan menggabungkan bahasa Inggris dengan forum, dengan syarat memenuhi standar yang ditentukan oleh guru bahasa Inggris per fase / kelasnya. </li>
<li>Untuk semua fase, tidak diperkenankan menggabungkan karya showcase dengan bahasa Inggris. Tujuan utama dari penampilan english adalah “SPEAKING”. </li>
</ul>
<b>Forum</b>
<ul>
<li>Untuk semua fase boleh menampilkan dalam bentuk stage. Sesuai dengan standar beginner dan intermediate yang telah ditentukan. </li>
<li>Untuk semua fase boleh menampilkan dalam bentuk video. Sesuai dengan standar beginner dan intermediate yang telah ditentukan. </li>
<li>Videography adalah kegiatan belajar yang masuk dalam kategori forum. Jadi videography tanpa digabungkan oleh karya alam sosial maupun english, tetap terhitung sebagai penampilan forum. Sesuai dengan standar beginner dan intermediate yang telah ditentukan. </li>
<li>Dari semua jenis forum yang diambil oleh anak, boleh dipilih hanya salah satu yang ditampilkan di acara Production. Misalnya mengambil forum videography, piano dan forum menjahit mandiri. Yang mau ditampilkan hanya piano. </li>
<li>Untuk fase scholar 4 - 6, tidak diperkenankan punya forum mandiri di jam sekolah dan menampilkan karya acara Production dari forum mandiri. Karena masih butuh bimbingan penuh. Kecuali yang dilihat berkompeten oleh juri Forum, yaitu pak guru Fahri, ka Dinna dan ka Adi. </li>
<li>Untuk fase scholar 7 - 12, diperbolehkan menampilkan karya forum otodidak / mandiri untuk acara Production. Dengan syarat berkonsultasi dengan tim juri Forum, yaitu pak guru Fahri, ka Dinna dan ka Adil untuk standar karyanya. </li>
</ul>
<br/>
<b>Panduan Formulir Pendaftaran :</b> <br/>
a. Nama Lengkap<br/>
b. Judul Penampilan<br/>
c. Pilihan jenis karya <small>(stage, showcase, video)</small>
d. Pilihan tema <small>(alam, sosial, english, forum / campuran. Khusus untuk campuran, harus ada konfirmasi guru mapel terkait yang mengkonfirmasi baru bisa milih karya model tersebut).</small> 
e. Upload storyboard <small>(tanpa upload storyboard ga bisa daftar otomatis)</small>
f. Upload hasil penilaian guru terkait dari buku my project <small>(standar kualitas, wajib dan ga bisa daftar kalo ga upload)</small>
g. Perkiraan durasi untuk yang video dan stage <small>(wajib diketik sama peserta)</small>
h. List prop: yang dibawa pribadi, yang dibutuhkan dari sekolah <small>(ppt, sound system, mic, dan fasilitas sekolah lainnya)</small>
</div>
    
            <div class="mt-6 text-right">
                <button onclick="toggleModal()" class="small-button bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded">
                    Paham
                </button>
            </div>
        </div>
    </div>
    <script>
        function toggleModal() {
            const modal = document.getElementById('popupModal');
            const isHidden = modal.classList.contains('hidden');
    
            modal.classList.toggle('hidden');
    
            if (isHidden) {
                document.body.classList.add('overflow-hidden');
            } else {
                document.body.classList.remove('overflow-hidden');
            }
        }
    </script>      
</x-app-layout>
