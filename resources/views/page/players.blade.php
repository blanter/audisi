@section('title', 'Data Tamu')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32l85.6 0c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4l-96 0c-35.3 0-64 28.7-64 64zm461.6 32l82.4 0c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64l-96 0c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4l-96 0c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32l576 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L32 416z') }}"/></svg></span>
            Data Tamu</h2>
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
            <div class="home-generator custom-table">
                <div class="my-pages">
                    <h1 class="custom-heading">Data Tamu</h1>
                    <div class="player-container">
                        <div id="players">
                            <div class="player-heading">
                                <div class="player-name">Player Name</div>
                                <div class="player-score">Joined at</div>
                            </div>
                            @php $number=0; @endphp
                            @foreach($getplayers as $player)
                            @if($player->player == 0)
                            @else
                            <div class="player-list no-grid">
                                <div class="player-data">
                                    <div class="player-name">{{$player->name}} - Player {{$player->player}}</div>
                                    <div class="player-score"><span class="timeago" data-datetime="{{$player->created_at}}"></span></div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// CUSTOM TIMEAGO BY CHAT GPT
document.addEventListener("DOMContentLoaded",function(){function t(){const t=document.querySelectorAll("span.timeago");t.forEach(function(t){var e=t.getAttribute("data-datetime"),e=Math.floor((new Date-new Date(e))/1e3);let o=Math.floor(e/31536e3);1<o?t.textContent=o+" years ago":(o=Math.floor(e/2592e3),1<o?t.textContent=o+" months ago":(o=Math.floor(e/86400),1<o?t.textContent=o+" days ago":(o=Math.floor(e/3600),1<o?t.textContent=o+" hours ago":(o=Math.floor(e/60),1<o?t.textContent=o+" minutes ago":t.textContent=Math.floor(e)+" seconds ago"))))})}t(),setInterval(t,6e4)});
</script>
</x-app-layout>