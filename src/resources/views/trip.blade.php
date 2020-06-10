@extends('layouts.layout')

@section('content')
<div class="flex-grow flex flex-col bg-white">
    <div class="flex justify-between px-6 border-b items-center">
        <a href="{{ url('/') }}">
            <h3 class="py-4 font-bold text-lg">trips</h3>
        </a>
    </div>

    @foreach ($trips as $trip)
        <div class="flex flex-col text-gray-700 bg-gray-100 border-b-4 border-gray-700 border-l-8">

            <div class="flex flex-row">
                <div class="flex-col p-3 text-center border-r">
                    <b class="font-black text-lg">VAN</b>
                    <p class="text-sm">{{ $trip['legs']['0']['origin']['name'] }}</p>

                    <b class="font-black text-lg">NAAR</b>
                    <p class="text-sm mb-2">{{ $trip['legs'][count($trip['legs'])-1]['destination']['name'] }}</p>

                    <b class="font-black text-lg">BEGIN</b>
                    <p class="text-sm">{{ date('d-m-Y H:i', strtotime($trip['legs'][0]['origin']['plannedDateTime'])) }}</p>

                    <b class="font-black text-lg">EIND</b>
                    <p class="text-sm">{{ date('d-m-Y H:i', strtotime($trip['legs'][count($trip['legs'])-1]['destination']['plannedDateTime'])) }}</p>
                </div>

                <div class="flex flex-col justify-center flex-grow overflow-y-auto">
                    @if (isset($trip['fares']) && count($trip['fares']) > 0)
                        @foreach ($trip['fares'] as $fare)
                            <div class="flex flex-col flex-grow px-2 py-1 border-b">
                                <p class="mb-1">{{ $fare['product'] }}</p>
                                <div class="flex flex-row">
                                    <div class="flex flex-row flex-grow">
                                        <div class="tracking-normal text-white bg-blue-400 px-2 text-xs rounded leading-loose mr-2 font-semibold">{{ $fare['travelClass'] }}</div>
                                        <div class="tracking-normal text-white bg-blue-400 px-2 text-xs rounded leading-loose mr-2 font-semibold">{{ $fare['discountType'] }}</div>
                                    </div>
                                    <div class="font-black text-lg">€{{ $fare['priceInCents']/100 }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if (isset($trip['fareOptions']['reasonEticketNotBuyable']['description']))
                        {{ $trip['fareOptions']['reasonEticketNotBuyable']['description'] }}
                    @endif
                </div>
            </div>

            <div class="flex flex-row items-stretch bg-white overflow-y-auto w-full border-t">

                <div class="flex flex-row py-2 px-4 items-center justify-around">
                    <div class="flex flex-col text-center">
                        <p>{{ $trip['legs'][0]['origin']['name'] }}</p>
                        <b>{{ date('H:i:s', strtotime($trip['legs'][0]['origin']['plannedDateTime'])) }}</b>

                        @if (isset($trip['legs'][0]['product']['displayName']))
                        <p>{{ $trip['legs'][0]['product']['displayName'] }}</p>
                        @endif

                        <b>{{ $trip['legs'][0]['travelType'] }}</b>
                    </div>
                </div>

                @foreach ($trip['legs'] as $leg)

                <div class="flex justify-center items-center w-16">
                    <span class="font-black text-lg px-2">🡆</span>
                </div>

                <div class="flex flex-row bg-white py-2 px-4 items-center justify-center">
                    <div class="flex flex-col text-center">
                        <p>{{ $leg['destination']['name'] }}</p>
                        <b>{{ date('H:i:s', strtotime($leg['origin']['plannedDateTime'])) }} - {{ date('H:i:s', strtotime($leg['destination']['plannedDateTime'])) }}</b>
                        <b></b>

                        @if (isset($leg['product']['displayName']))
                        <p>{{ $leg['product']['displayName'] }}</p>
                        @endif

                        <b>{{ $leg['travelType'] }}</b>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
