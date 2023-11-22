<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BMKGController extends Controller
{
    public function getIndexBMKG(Request $request) {
        $userIpAddress = $request->ip(); // Mendapatkan alamat IP pengguna dari request

        $geoLocation = $this->getGeoLocation($userIpAddress);

        if ($geoLocation) {
            $province = $geoLocation;
            $city = $geoLocation;

            // Gunakan provinsi dan kota untuk mendapatkan data cuaca
            $getWeather = $this->getWeather($province, $city);

            $getQuakeData = $this->getQuakeData();
            $quakeBigData = $this->quakeBigData();

            return view('weather', compact('getWeather', 'getQuakeData', 'quakeBigData'));
        } else {
            // Handle kesalahan ketika tidak dapat mendapatkan informasi geolokasi
            return "Failed to fetch geolocation data.";
        }
    }

    public function getQuakeData()
    {
        $urlQuake = "http://35.219.123.247/quake";
        $quakeResponse = Http::get($urlQuake);

        if ($quakeResponse->successful()) {
            $quakeData = $quakeResponse->json()["data"];
            return $quakeData;
        } else {
            // Handle kesalahan saat mengambil data dari API quake
            return "Failed to fetch quake data from API";
        }
    }

    public function quakeBigData(){
        $urlBigQuake = "http://35.219.123.247/list-quake";
        $quakeBigResponse = Http::get($urlBigQuake);

        if ($quakeBigResponse->successful()) {
            $quakeBigData = $quakeBigResponse->json()["data"];

            return $quakeBigData;
        } else {
            return "Failed to fetch big quake data from API";
        }
    }

    public function getWeather($province, $city){

        $urlWeather = "http://35.219.123.247/weather/{$province}/{$city}";
        $weatherResponse = Http::get($urlWeather);

        if ($weatherResponse->successful()) {
            $weatherData = $weatherResponse->json()["data"];
            
            return $weatherData;
        } else {
            return "Failed to fetch weather data from API";
        }
    }

    public function getGeoLocation($userIpAddress) {
        $accessKey = '15c5d0ba5a62d20842aa1b1ee5a3b4ea';
        $url = "http://api.ipstack.com/{$userIpAddress}?access_key={$accessKey}";
    
        try {
            $geoLocationData = json_decode(file_get_contents($url), true);
            // dd($geoLocationData);
            if (isset($geoLocationData['region_name']) && isset($geoLocationData['city'])) {
                $province = $geoLocationData['region_name'];
                $city = $geoLocationData['city'];
                return compact('province', 'city');
            } else {
                // Log or return an error message if the expected data is not present
                return "Invalid geolocation data format.";
            }
        } catch (\Exception $e) {
            // Log or return an error message if an exception occurs
            return "Error fetching geolocation data: " . $e->getMessage();
        }
    }
}
