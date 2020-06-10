<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    private $API_CLIENT;

    public function __construct()
    {
        $this->API_CLIENT = new Client([
            'base_uri' => 'https://gateway.apiportal.ns.nl',
            'headers' => [
                'Accept'    => 'application/json',
                'Ocp-Apim-Subscription-Key' => env('NS_API_KEY')
            ]
        ]);
    }

    public function stations()
    {
        $response = $this->API_CLIENT->get('reisinformatie-api/api/v2/stations');
        $stations = json_decode($response->getBody()->getContents(), true)['payload'];

        if (isset($_GET['station']) && !empty($_GET['station'])) {
            $station = $_GET['station'];

            $stations = array_filter($stations, function($var) use ($station) {
                return (stripos($var['namen']['lang'], $station) !== false);
            });
        }

        return view('index', [
            'stations' => $stations
        ]);
    }

    public function stationDetails(Request $request)
    {
        $now = now('Europe/Amsterdam')->format(\DateTime::RFC3339);

        $response = $this->API_CLIENT->get('reisinformatie-api/api/v2/stations');
        $stations = json_decode($response->getBody()->getContents(), true)['payload'];

        $response = $this->API_CLIENT->get('reisinformatie-api/api/v2/arrivals?uicCode='.$request->uicCode.
            '&dateTime='.$now.
            '&lang=nl');
        $arrivals = json_decode($response->getBody()->getContents(), true)['payload']['arrivals'];

        $response = $this->API_CLIENT->get('reisinformatie-api/api/v2/departures?uicCode='.$request->uicCode.
            '&dateTime='.$now.
            '&lang=nl');
        $departures = json_decode($response->getBody()->getContents(), true)['payload']['departures'];

        $filteredStations = array_filter($stations, function($var) use ($request) {
            return ($var['UICCode'] === $request->uicCode);
        });

        $index = array_keys($filteredStations)[0]; // index of filtered station(s)
        $station = $filteredStations[$index];

        $destinations = null;
        if (isset($_GET['toStation']) && !empty($_GET['toStation'])) {
            $destination = $_GET['toStation'];

            $destinations = array_filter($stations, function($var) use ($destination, $request) {
               return (stripos($var['namen']['lang'], $destination) !== false) && $var['UICCode'] !== $request->uicCode;
            });
        }

        $departureDate = isset($_GET['departureDate'])
            ? $_GET['departureDate']
            : date('Y-m-d', strtotime($now)).'T'.date('H:i', strtotime('+2 hours')); // Workaround timeformat for DateTime picker

        return view('station', [
            'station' => $station,
            'arrivals' => $arrivals,
            'departures' => $departures,
            'departureDate' => $departureDate,
            'destinations' => $destinations
        ]);
    }

    public function trips(Request $request)
    {
        $departureDate = isset($_GET['departureDate'])
            ?(new \DateTime($_GET['departureDate']))->format(\DateTime::RFC3339)
            : now()->format(\DateTime::RFC3339);

        $searchForArrival = isset($_GET['searchForArrival'])
            ? $_GET['searchForArrival']
            : false;

        $response = $this->API_CLIENT->get('reisinformatie-api/api/v3/trips?originUicCode='.$request->uicCodeOrigin.
            '&destinationUicCode='.$request->uicCodeDestination.
            '&dateTime='.$departureDate.
            '&searchForArrival='.$searchForArrival);
        $trips = json_decode($response->getBody()->getContents(), true)['trips'];

        return view('trip', [
            'trips' => $trips
        ]);
    }
}
