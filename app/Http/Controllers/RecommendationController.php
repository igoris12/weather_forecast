<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



define('VALID_CATCHE', 30);

class RecommendationController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $town = $request->town_name;
        $url = 'https://api.meteo.lt/v1/places/'.$town.'/forecasts/long-term';
        $data = cache()->remember('forecast-data', 60, function($url) {
            return Http::get($url)->json();
        });

        // echo '<pre>';
       print_r($data['forecastTimestamps']);  


        $town_name = $data['place']['name'];
        $forecast =$data['forecastTimestamps'];

    
        
        
    
        // dd($data);




        $recommendations = Recommendation::where('type', 'clear' )->orderBy('name', 'desc')->get();
        return view('recommendation.index', ['recommendations' => $recommendations, 'town' => $town_name]);
    }




     public function fromServer(string $town) : array
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL,'https://api.meteo.lt/v1/places/'.$request->town_name.'/forecasts/long-term');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $answer = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($answer);
        
        // $forecastance = $data->forecastance;

        
        $recommendations = Recommendation::where('type', 'na' )->orderBy('name', 'desc')->get();
        return view('recommendation.index', ['recommendations' => $recommendations]);
    
        dd($data);
        return [$data, time()];
    }

}
