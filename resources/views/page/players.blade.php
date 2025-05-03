@section('title', 'Active Players')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"></span>
            Active Players</h2>
    </x-slot>
<div class="home-generator">
    <div class="my-pages">
        <h1 class="custom-heading">Active Players</h1>
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
                        <div class="player-score"><span class="timeago" data-datetime="{{$player->created_at}}"></span> <i class="bi bi-clock-fill"></i></div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
// CUSTOM TIMEAGO BY CHAT GPT
$(document).ready(function(){function t(){$("span.timeago").each(function(){var t=$(this).attr("data-datetime");$(this).text(function(t){t=Math.floor((new Date-new Date(t))/1e3);let o=Math.floor(t/31536e3);return 1<o?o+" years ago":(o=Math.floor(t/2592e3),1<o?o+" months ago":(o=Math.floor(t/86400),1<o?o+" days ago":(o=Math.floor(t/3600),1<o?o+" hours ago":(o=Math.floor(t/60),1<o?o+" minutes ago":Math.floor(t)+" seconds ago"))))}(t))})}t(),setInterval(t,6e4)});
</script>
</x-app-layout>