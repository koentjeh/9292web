@extends('layouts.layout')

@section('content')
<div class="flex-grow flex flex-col bg-white">
    <div class="flex justify-between px-6 border-b items-center">
        <a href="{{ url('/') }}" class="py-4 font-bold text-lg flex-grow">
            Terug
        </a>
        <p class="font-black text-2xl w-16 text-center mb-1">
            {{ $station['land'] }}
        </p>
        <p class="text-md sm:text-2xl font-bold flex-grow text-gray-700">
            {{ $station['namen']['lang'] }}
        </p>
        <div class="hidden sm:block">
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

    <div class="flex flex-col justify-center items-center w-full py-12 text-gray-700 bg-gray-100 border-b-2 px-10">

        <p class="font-bold text-sm md:text-lg uppercase mb-4">Plan een reis</p>

        <div class="relative text-gray-600 w-full max-w-lg">
            <form method="get">
                <input type="search" name="toStation" placeholder="Zoeken" value="{{ $_GET['toStation'] ?? '' }}" class="bg-gray-300 h-10 px-5 pr-10 mb-3 rounded-full text-sm focus:outline-none w-full font-medium">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                    </svg>
                </button>

                <div class="flex flex-row rounded-t-lg overflow-hidden font-medium text-center">
                    <input id="x" type="radio" name="searchForArrival" value="false" class="absolute invisible" checked>
                    <label for="x" class="w-1/2 py-3 bg-gray-300">vertrek</label>

                    <input id="y" type="radio" name="searchForArrival" value="true"  class="absolute invisible">
                    <label for="y" class="w-1/2 py-3 bg-gray-300">aankomst</label>
                </div>

                <input type="datetime-local" name="departureDate" value="{{ $departureDate }}" class="w-full p-3 mb-3 leading-none rounded-b-lg shadow-sm focus:outline-none bg-gray-300 focus:shadow-outline text-gray-600 font-medium">

                @if (isset($destinations) && count($destinations) > 0)
                    <div style="max-height: 250px;overflow-y: auto;">
                        @foreach ($destinations as $destination)
                            <button type="submit" formaction="{{ url('/'.$station['UICCode'].'/'.$destination['UICCode']) }}" class="flex flex-row w-full justify-between border-b p-2 justify-center align-center hover:bg-gray-300">
                                <p>{{ $station['namen']['lang'] }} <span class="font-black">🡆</span> {{ $destination['namen']['lang'] }}</p>
                                <p class="uppercase text-xs">Ticket bekijken</p>
                            </button>
                        @endforeach
                    </div>

                @elseif (isset($destinations))
                    <p class="text-red-400">geen bestemmingen gevonden...</p>
                @endif
            </form>
        </div>
    </div>

    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 lg:border-r-2 text-gray-700">
            <div class="flex flex-grow text-gray-700 border-b-2 bg-gray-100 items-center py-3 px-6">
                <p class="flex-grow"></p>
                <b>Spoor</b>
                <b class="text-right" style="width: 110px">Aankomst</b>
            </div>

            @foreach ($arrivals as $arrival)
            <div class="flex flex-grow text-gray-700 border-b hover:bg-gray-100 items-center py-3 px-6">

                <p class="flex-grow">
                    <b>van:</b> {{ $arrival['origin'] }}
                </p>

                <p class="font-black text-sm md:text-lg">
                    @if (isset($arrival['actualTrack']))
                    {{ $arrival['actualTrack'] }}
                    @elseif (isset($arrival['plannedTrack']))
                    {{ $arrival['plannedTrack'] }}
                    @else
                    ?
                    @endif
                </p>

                <p class="font-black text-sm md:text-lg text-right" style="width: 110px">
                    {{ date('H:i:s', strtotime($arrival['plannedDateTime'])) }}
                </p>
            </div>
            @endforeach
        </div>

        <div class="w-full lg:w-1/2 text-gray-700">
            <div class="flex flex-grow text-gray-700 border-b-2 bg-gray-100 items-center py-3 px-6">
                <p class="flex-grow"></p>
                <b>Spoor</b>
                <b class="text-right" style="width: 110px">Vertrek</b>
            </div>

            @foreach ($departures as $departure)
            <div class="flex flex-grow text-gray-700 border-b hover:bg-gray-100 justify-between items-center py-3 px-6">

                <p class="flex-grow">
                    <b>naar:</b> {{ $departure['direction'] }}
                </p>

                <p class="font-black text-sm md:text-lg">
                    @if (isset($departure['actualTrack']))
                    {{ $departure['actualTrack'] }}
                    @elseif (isset($departure['plannedTrack']))
                    {{ $departure['plannedTrack'] }}
                    @else
                    ?
                    @endif
                </p>

                <p class="font-black text-sm md:text-lg text-right" style="width: 110px">
                    {{ date('H:i:s', strtotime($departure['plannedDateTime'])) }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
