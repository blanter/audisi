@section('title', 'Data QR Tamu')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"></span>
            Data QR Tamu</h2>
    </x-slot>

    <div class="pt-1 pb-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6">
                <div class="custom-box-qr">
                    <div class="box-qr">
                        <a href="{{route('qrform')}}" title="QR Form Tamu">
                            <span>QR Form Tamu</span>
                        </a>
                    </div>
                    <div class="box-qr">
                        <a href="{{route('qrscan')}}" title="QR Scan Tamu">
                            <span>QR Scan Tamu</span>
                        </a>
                    </div>
                    <div class="box-qr">
                        <a href="{{route('players')}}" title="QR Form Tamu">
                            <span>Data Tamu</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
