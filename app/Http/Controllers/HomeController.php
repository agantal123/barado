<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\sensordata;
use Carbon\Carbon;

use App\Charts\Reused_waterCharts;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //total amount of water value
        $totalWaterLevelValue = DB::table('sensor_data')->sum('loadcell_value');
        //total amount of load cell  value
        //$totalAmountThisDay = DB::table('sensor_data')->whereDate('created_at', date('Y-m-d'))->sum('loadcell_value');
        //most recent water water
        $totalAmountThisDay = sensordata::latest('created_at')->first();
        $mostrecentwaterlevelvalue = sensordata::latest('created_at')->first();
        
        //get sensor data table
        $all_data = sensordata::all()->sortBy('created_at');
        
       
        return view('dashboard', compact('totalWaterLevelValue','totalAmountThisDay','mostrecentwaterlevelvalue','all_data'));

    }

    public function mayChart()
    {
        $totalloadcellvalue = DB::table('sensor_data')->sum('loadcell_value');
        $totalAmountThisDay = sensordata::latest('created_at')->first();

        $totalwaterlevelvalue = DB::table('sensor_data')->sum('water_level_value');
        $water = sensordata::latest()->take(30)->get()->sortBy('id');
        
        $labels = $water->pluck('created_at');
        $data = $water->pluck('water_level_value');
        $data2 = $water->pluck('loadcell_value');
        

        return response()->json(compact('labels', 'data','data2' , 'totalwaterlevelvalue','totalloadcellvalue','totalAmountThisDay'));
    }

    
 
   
}
