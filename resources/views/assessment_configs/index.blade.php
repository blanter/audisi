@section('title', 'Data Standar Penilaian')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="custom-heading-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg></span>
            {{ __('Data Standar Penilaian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('standar-nilai.create') }}" class="small-button bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Standar</a>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @foreach($configs as $level => $types)
                <div class="mt-6 custom-list">
                    <h2 class="text-xl font-semibold text-green-700">{{ ucfirst($level) }}</h2>
                    @foreach($types as $artType => $criteria)
                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-gray-700">{{ $artType }}</h3>
                            @foreach($criteria as $item)
                                <div class="border p-4 mb-2 border rounded-xl shadow-sm items-start">
                                    <p class="font-medium">{{ $item->title }} ({{ $item->type }})</p>
                                    <ul class="list-disc pl-6">
                                        @foreach($item->options as $option)
                                            <li>{{ $option['label'] }} — {{ $option['value'] }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="mt-2">
                                        <a href="{{ route('standar-nilai.edit', $item->id) }}" class="p-3 pt-1 rounded-xl pb-1 inline-block bg-blue-500 text-white mr-2">Edit</a>
                                        <form action="{{ route('standar-nilai.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
