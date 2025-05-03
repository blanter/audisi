@section('title', 'Camera Stream QR Scanner')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg></span>
            QR Scanner</h2>
    </x-slot>

    <div class="py-6">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white p-6 custom-pagebox custom-pagebg">
            <div class="bee-leaf">
              <div class="svg-bee"><img src="{{ asset('/img/bee.svg') }}"/></div>
              <div class="svg-leaf1"><img src="{{ asset('/img/leaf1.svg') }}"/></div>
              <div class="svg-leaf2"><img src="{{ asset('/img/leaf2.svg') }}"/></div>
              <div class="svg-leaf3"><img src="{{ asset('/img/leaf3.svg') }}"/></div>
              <div class="svg-leaf4"><img src="{{ asset('/img/leaf4.svg') }}"/></div>
              <div class="bees1"><img src="{{ asset('/img/bees.svg') }}"/></div>
              <div class="bees2"><img src="{{ asset('/img/bees.svg') }}"/></div>
              <div class="bees3"><img src="{{ asset('/img/bees.svg') }}"/></div>
              <div class="bees4"><img src="{{ asset('/img/bees.svg') }}"/></div>
          </div>
            <script src="{{ asset('/js/html5-qrcode.min.js')}}"></script>
            <div class="home-generator custom-table">
              <div class="reader-container">
                <h1 class="custom-heading">Welcome to Production 29th</h1>
                <div class="only-reader big-container">
                    <div id="reader"></div>
                </div>
              </div>
                @if (session('name'))
                <div id="big-welcome">
                  <div class="myname">
                    <h3>SELAMAT DATANG {{session('player')}}</h3>
                    <h2>{{ session('name') }}</h2>
                  </div>
                </div>
                @endif
            </div>
            <form id="myForm" action="{{ route('submit.player') }}" method="POST" style="display:none">
              @csrf
              <input id="myName" type="text" id="name" name="name" required="" value="">
            </form>
          </div>
        </div>
      </div>

<script>
// PLAY SOUND
function playSoundx() {
  var mySound = new Audio("{{ asset('/welcome.mp3') }}");
  mySound.loop = false;
  mySound.autoplay = true;
  mySound.play();
}
function initializeQrScanner() {
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    playSoundx();
    function onScanSuccess(qrCodeMessage) {
        $("#myForm input#myName").val(qrCodeMessage);
        document.getElementById('myForm').submit();
        playSoundx();
        html5QrcodeScanner.clear();
    }
    html5QrcodeScanner.render(onScanSuccess);
}
setTimeout(initializeQrScanner, 1000);
</script>
@if(session('name'))
<script>
playSoundx();
</script>
@endif
</x-app-layout>