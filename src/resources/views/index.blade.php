@extends('layouts.layout')

@section('content')
<div class="flex-grow flex flex-col bg-white">
    <div class="flex justify-between px-6 border-b items-center">
        <a href="{{ url('/') }}">
            <h3 class="py-4 font-bold text-lg">Stations</h3>
        </a>

        <div class="relative text-gray-600 w-1/3">
            <form action="{{ url('/') }}" method="get">
                <input type="search" name="station" placeholder="Zoeken" value="{{ $_GET['station'] ?? '' }}" class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    @foreach ($stations as $station)
    <a href="{{ url('/'.$station['UICCode']) }}">
        <div class="flex flex-grow text-gray-700 border-b hover:bg-gray-100 items-center pr-3 py-3">
            <p class="font-black text-2xl w-16 text-center mb-1">
                {{ $station['land'] }}
            </p>
            <div class="flex flex-col flex-grow">
                <p class="text-lg font-bold">{{ $station['namen']['lang'] }}</p>
                <div>
                    @if ($station['heeftFaciliteiten'])
                        <span class="tracking-normal text-white bg-green-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Faciliteiten</span>
                    @else
                        <span class="tracking-normal text-white bg-red-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Faciliteiten</span>
                    @endif
                    @if ($station['heeftVertrektijden'])
                        <span class="tracking-normal text-white bg-green-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Vertrektijden</span>
                    @else
                        <span class="tracking-normal text-white bg-red-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Vertrektijden</span>
                    @endif
                    @if ($station['heeftReisassistentie'])
                        <span class="tracking-normal text-white bg-green-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Reisassistentie</span>
                    @else
                        <span class="tracking-normal text-white bg-red-400 px-2 py-1 text-xs rounded leading-loose mr-2 font-semibold">Reisassistentie</span>
                    @endif
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>


@endsection
