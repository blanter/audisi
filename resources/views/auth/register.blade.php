<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // ABCLA2025
        function _0xe857(){const _0xbfa68=['ywjJBgeYmdi1','mty0mdy0u1j1DMTe','ywrKrxzLBNrmAxn0zw5LCG','mJGYmJa5mKLNCLbutG','A29Kzq','nJu0nJGXD3LKCujY','ndH1zLnWvwy','mZK4ntiZnKvXuM5gtG','mtaWmdK4zwnAD2fo','z2v0sxrLBq','nty5nZKWowXmsMrTyq','mtG1A0PXEMXz','re9nq29UDgvUDeXVywrLza','ogLlCMTvDG','odu1otuYmhHjy05Ata'];_0xe857=function(){return _0xbfa68;};return _0xe857();}function _0x439e(_0x3e31e1,_0x58b7a7){const _0xe8578e=_0xe857();return _0x439e=function(_0x439e1f,_0x120610){_0x439e1f=_0x439e1f-0x108;let _0x1a110c=_0xe8578e[_0x439e1f];if(_0x439e['CHMTkK']===undefined){var _0x162c30=function(_0x23f93a){const _0xadcfb6='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';let _0x500a4c='',_0x41ef70='';for(let _0xb1b65f=0x0,_0x13eb86,_0x40e485,_0x3aeccb=0x0;_0x40e485=_0x23f93a['charAt'](_0x3aeccb++);~_0x40e485&&(_0x13eb86=_0xb1b65f%0x4?_0x13eb86*0x40+_0x40e485:_0x40e485,_0xb1b65f++%0x4)?_0x500a4c+=String['fromCharCode'](0xff&_0x13eb86>>(-0x2*_0xb1b65f&0x6)):0x0){_0x40e485=_0xadcfb6['indexOf'](_0x40e485);}for(let _0x415578=0x0,_0x6297a9=_0x500a4c['length'];_0x415578<_0x6297a9;_0x415578++){_0x41ef70+='%'+('00'+_0x500a4c['charCodeAt'](_0x415578)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(_0x41ef70);};_0x439e['PfuDib']=_0x162c30,_0x3e31e1=arguments,_0x439e['CHMTkK']=!![];}const _0x1393ea=_0xe8578e[0x0],_0x5bce71=_0x439e1f+_0x1393ea,_0x55e5b3=_0x3e31e1[_0x5bce71];return!_0x55e5b3?(_0x1a110c=_0x439e['PfuDib'](_0x1a110c),_0x3e31e1[_0x5bce71]=_0x1a110c):_0x1a110c=_0x55e5b3,_0x1a110c;},_0x439e(_0x3e31e1,_0x58b7a7);}const _0x21e2c9=_0x439e;(function(_0x37600a,_0x2ae8b3){const _0x26cc23=_0x439e,_0x3a5fde=_0x37600a();while(!![]){try{const _0x2370bf=parseInt(_0x26cc23(0x10d))/0x1+parseInt(_0x26cc23(0x10e))/0x2*(-parseInt(_0x26cc23(0x109))/0x3)+-parseInt(_0x26cc23(0x10f))/0x4+parseInt(_0x26cc23(0x113))/0x5*(parseInt(_0x26cc23(0x110))/0x6)+parseInt(_0x26cc23(0x10b))/0x7+-parseInt(_0x26cc23(0x115))/0x8*(-parseInt(_0x26cc23(0x112))/0x9)+parseInt(_0x26cc23(0x116))/0xa;if(_0x2370bf===_0x2ae8b3)break;else _0x3a5fde['push'](_0x3a5fde['shift']());}catch(_0x555c17){_0x3a5fde['push'](_0x3a5fde['shift']());}}}(_0xe857,0xd0d2c),document[_0x21e2c9(0x10a)](_0x21e2c9(0x114),function(){const _0x3b40e5=_0x21e2c9,_0x23f93a=_0x3b40e5(0x108);if(localStorage[_0x3b40e5(0x111)](_0x3b40e5(0x10c))===_0x23f93a)return;if(typeof tanpakode!=='undefined')return;const _0xadcfb6=prompt('Masukkan\x20kode:','');_0xadcfb6===_0x23f93a?localStorage['setItem'](_0x3b40e5(0x10c),_0x23f93a):(alert('Kode\x20salah!'),location['reload']());}));
    </script>        
</x-guest-layout>
