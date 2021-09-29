<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;

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
        // dd($request);
        if ($request->town) {
            $curl=curl_init();
            curl_setopt($curl,CURLOPT_URL,'https://api.meteo.lt/v1/places/vilnius/forecasts/long-term');
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            $answer = curl_exec($curl);
            curl_close($curl);

            $data = json_decode($answer);
            $nweData = [];
            echo "<pre>";
            for($i = 0; $i <= 54; $i++) {
                $nweData[] = $data->forecastTimestamps[$i];
            }

        //    print_r($nweData);
        foreach($nweData as $data) {
                    // print_r($data);
        }
// echo date("Y-m-". (int)date("d") +2 ." H:00:00");
// echo date("Y-m-d H:i:s");
// setlocale(LC_TIME, 'lt_LT.UTF-8');
// echo strftime('%c');
        // echo date("Y-m-". (int)date("d") +2 ." H:00:00");
// date("Y-m-d H:i:s");
        }

         $recommendations = Recommendation::where('type', 'na' )->orderBy('name', 'desc')->get();
        return view('recommendation.index', ['recommendations' => $recommendations]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {

    //     return redirect()->route('recommendation.index')->with('success_message', 'New Parcel added successful.');

    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function show(Recommendation $recommendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function edit(Recommendation $recommendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recommendation $recommendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation)
    {
        //
    }
}
