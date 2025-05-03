@section('title', 'Camera Stream QR Scanner')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"></span>
            QR Scanner</h2>
    </x-slot>
<script src="{{ asset('/js/html5-qrcode.min.js')}}"></script>
<div class="home-generator">
  <div class="reader-container">
    <h1 class="custom-heading">Welcome to Production 28th</h1>
    <div class="only-reader big-container">
        <div id="reader"></div>
    </div>
  </div>
    @if (session('name'))
    <div id="big-welcome">
      <div class="myname">
        <h3>SELAMAT DATANG PLAYER {{session('player')}}</h3>
        <h2>{{ session('name') }}</h2>
      </div>
    </div>
    @endif
</div>
<form id="myForm" action="{{ route('submit.player') }}" method="POST" style="display:none">
  @csrf
  <input id="myName" type="text" id="name" name="name" required="" value="">
</form>

<script>
// PLAY SOUND
function playSoundx() {
  var mySound = new Audio("{{ asset('/public/welcome.mp3') }}");
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

// HIDDEN
$(document).ready(function() {
  setTimeout(function() {
    $("#big-welcome").fadeOut(500, function() {
      $(this).hide();
    });
  }, 5000);
});
</script>
@endif
</x-app-layout>