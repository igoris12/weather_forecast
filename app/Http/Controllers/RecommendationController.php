<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Validator;


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
        $towns = ['alytus','kaunas','klaipeda','panevezys','siauliai','vilnius','marijampole','mazeikiai','zarasai'];
        $max = count($towns);
        // dd( $max);
        $validator = Validator::make(
            $request->all(),
            [
                'town_name' => [ 'integer', 'min:0', "max:$max"],
                
            ]

        );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        if ($request->town_name) {
            $url = 'https://api.meteo.lt/v1/places/'.$towns[$request->town_name -1].'/forecasts/long-term';
            
            $data = Http::get($url)->json();
            Cache::put('weather_forecast', $data, now()->addMinutes(5));
            $data = Cache::get('weather_forecast');
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

            $recommendations = Recommendation::all();
            return view('recommendation.index', ['recommendations' => $recommendations, 'town' => $town , 'weather_forecast' => $weather_forecast]);
        }
         return view('recommendation.index', ['recommendations' => [], 'town' => '0' , 'weather_forecast' => []]);
    }
}
