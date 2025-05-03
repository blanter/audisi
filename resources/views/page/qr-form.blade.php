@section('title', 'Generate QR Code')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"></span>
            Generate QR Code</h2>
    </x-slot>
<div class="home-generator">
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

<script>
var tanpakode = true;
</script>
</x-app-layout>