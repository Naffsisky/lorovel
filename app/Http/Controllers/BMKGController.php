<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BMKGController extends Controller
{
    public function getIndexBMKG(Request $request , $province = 'jawa-timur', $city = 'surabaya') {

        $province = $request->input('province', 'jawa-timur');
        $city = $request->input('city', 'surabaya');

        $getLocation = $this->getLocation( $province, $city);
        $getWeather = $this->getWeather();
        $getQuakeData = $this->getQuakeData();
        $quakeBigData = $this->quakeBigData();
        
        return view('weather', compact('getWeather', 'getQuakeData', 'quakeBigData', 'getLocation'));
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

    public function getLocation($province, $city){

        $urlWeather = "http://35.219.123.247/weather/$province/$city";
        $weatherResponse = Http::get($urlWeather);

        if ($weatherResponse->successful()) {
            $getLocation = $weatherResponse->json()["data"];
            
            return $getLocation;
        } else {
            return "Failed to fetch weather data from API";
        }
    }
    public function getWeather(){

        $urlWeather = "http://35.219.123.247/weather/banten/serang";
        $weatherResponse = Http::get($urlWeather);

        if ($weatherResponse->successful()) {
            $getWeather = $weatherResponse->json()["data"];
            
            return $getWeather;
        } else {
            return "Failed to fetch weather data from API";
        }
    }
}
