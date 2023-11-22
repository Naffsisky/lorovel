<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public function getIndexData() {
        $notesData = $this->getNotes();
        $newsData = $this->getNews();

        // Lakukan operasi lain jika diperlukan

        return view('index', compact('notesData', 'newsData'));
    }
    public function getNotes(){
        $urlNotes = "http://35.219.123.247/app2";
        $serverResponse = Http::get($urlNotes);

        if ($serverResponse->successful()) {
            $notesData = $serverResponse->json()['data']['notes'];

            $limitedNotes = array_slice($notesData, 0, 10);

            usort($limitedNotes, function ($a, $b) {
                return strtotime($b['createdAt']) - strtotime($a['createdAt']);
            });
            
            return $limitedNotes;
        } else {
            return "Failed to fetch data from API";
        }
    }

    public function getNews(){
        // $urlNews = "http://newsapi.org/v2/everything?q=keyword&apiKey=d14ab2781b58448f8a30e28701cf7598";
        $urlNews = "http://35.219.123.247/";
        $serverResponse = Http::get($urlNews);
    
        if ($serverResponse->successful()){
            // $newsData = $serverResponse->json()['articles'];
            $newsData = $serverResponse->json()['endpoint'];
            $limitedNews = array_slice($newsData, 0, 5);
            // dd($limitedNews);
            return $limitedNews;
        } else {
            return "Failed to fetch data from API";
        }
    }

    public function getFoods(Request $request)
    {
        $searchTerm = $request->input('search');

        $response = Http::get("https://www.themealdb.com/api/json/v1/1/search.php?s=$searchTerm");

        if ($response->successful()) {
            $searchResults = $response->json()['meals'];

            return view('foods', ['searchResults' => $searchResults]);
        } else {
            return "Failed to fetch data from API";
        }
    }
}
