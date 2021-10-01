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
     
        $url = 'https://api.meteo.lt/v1/places/'.$request->town_name.'/forecasts/long-term';
        
        $data = Http::get($url)->json();
        
        $town = $data['place']['name'];
        $weather_forecast = [];

     
    
        $h = date("H");

        if ((int)$h > 20) {
            $h = (int)$h - 23;
        }

        if ((int)$h+3 < 10) {
            $h = '0'.(int)$h+3;
        }else {
        $h =   (int)$h+3;
        }

        $dotay = date("Y-m-d $h:00:00");

        foreach($data['forecastTimestamps'] as $item) {
            if ($item['forecastTimeUtc'] == $dotay) {
                $weather_forecast[] = $item;
                break;
            }
        }

        $weather_forecast[] = $data['forecastTimestamps'][28];
        $weather_forecast[] = $data['forecastTimestamps'][52];

   // echo '<pre>';
    
        
        // print_r($data);    

        // echo '<br>';
        // print_r($weather_forecast);     



        $recommendations = Recommendation::where('type', 'clear' )->orderBy('name', 'desc')->get();
        return view('recommendation.index', ['recommendations' => $recommendations, 'town' => $town , 'weather_forecast' => $weather_forecast]);
    }




    //  public function fromServer(string $town) : array
    // {
    //     $curl = curl_init();

    //     curl_setopt($curl, CURLOPT_URL,'https://api.meteo.lt/v1/places/'.$request->town_name.'/forecasts/long-term');
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    //     $answer = curl_exec($curl);

    //     curl_close($curl);

    //     $data = json_decode($answer);
        
    //     // $forecastance = $data->forecastance;

        
    //     $recommendations = Recommendation::where('type', 'na' )->orderBy('name', 'desc')->get();
    //     return view('recommendation.index', ['recommendations' => $recommendations]);
    
    //     dd($data);
    //     return [$data, time()];
    // }

}
