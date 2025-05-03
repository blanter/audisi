@section('title', 'Generate QR Code')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z"/></svg></span>
            Generate QR Code</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 custom-pagebox custom-pagebg">
                <div class="bee-leaf">
                    <div class="svg-bee"><img src="https://production.lifebookacademy.sch.id/public/img/bee.svg"/></div>
                    <div class="svg-leaf1"><img src="https://production.lifebookacademy.sch.id/public/img/leaf1.svg"/></div>
                    <div class="svg-leaf2"><img src="https://production.lifebookacademy.sch.id/public/img/leaf2.svg"/></div>
                    <div class="svg-leaf3"><img src="https://production.lifebookacademy.sch.id/public/img/leaf3.svg"/></div>
                    <div class="svg-leaf4"><img src="https://production.lifebookacademy.sch.id/public/img/leaf4.svg"/></div>
                    <div class="bees1"><img src="https://production.lifebookacademy.sch.id/public/img/bees.svg"/></div>
                    <div class="bees2"><img src="https://production.lifebookacademy.sch.id/public/img/bees.svg"/></div>
                    <div class="bees3"><img src="https://production.lifebookacademy.sch.id/public/img/bees.svg"/></div>
                    <div class="bees4"><img src="https://production.lifebookacademy.sch.id/public/img/bees.svg"/></div>
                </div>
                <div class="home-generator custom-table">
                    <div class="container">
                        @if (!session('qrCode'))
                        <form action="{{ route('generate.qr') }}" method="POST">
                            @csrf
                            <label for="name">MASUKKAN NAMA ANDA</label>
                            <br/>
                            <input type="text" id="name" name="name" required="">
                            <button type="submit">Generate</button>
                        </form>
                        @endif
                        @if (session('qrCode'))
                        <div class="myname">
                            <h3>SELAMAT DATANG!</h3>
                            <h2>{{ session('name') }}</h2>
                        </div>
                        <div class="myqr">
                            <h2>Scan QR Code:</h2>
                            {{ session('qrCode') }}
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>

<script>
var tanpakode = true;
</script>
</x-app-layout>