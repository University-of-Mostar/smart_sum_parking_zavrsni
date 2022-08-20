<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use function Symfony\Component\String\b;

class StatisticsController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    function index(){



        return view('statistics');
    }

    public function index2(){

        $week = \Carbon\Carbon::today()->subDays(7);
        $week2 = \Carbon\Carbon::today()->subDays(14);
        $parking1thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();
        $parking1weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();
        $parking2weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();
        $parking2weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();
        $parking2thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                                ->where('id_parking_lot', '2')
                                ->count('id');
        $parking2lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                ->where('id_parking_lot', '2')
                                ->count('id');
        $parking3weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();
        $parking3weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();
        $parking3thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                                ->where('id_parking_lot', '3')
                                ->count('id');
        $parking3lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                ->where('id_parking_lot', '3')
                                ->count('id');
        $parking1percentage7days = round(($parking1weekStats/($parking1weekStats + $parking2weekStats + $parking3weekStats)*100), 2);
        $parking1percentage30days = round(($parking1thisMonthStats/($parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats)*100), 2);

        $parking2percentage7days = round(($parking2weekStats/($parking1weekStats + $parking2weekStats + $parking3weekStats)*100), 2);
        $parking2percentage30days = round(($parking2thisMonthStats/($parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats)*100), 2);

        $parking3percentage7days = round(($parking3weekStats/($parking1weekStats + $parking2weekStats + $parking3weekStats)*100), 2);
        $parking3percentage30days = round(($parking3thisMonthStats/($parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats)*100), 2);

        //PARKING 1 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 1: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 1', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking1_tjedna = new LaravelChart($chart_options);

        //PARKING 1 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 1: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 1', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking1_mjesecna = new LaravelChart($chart_options);

        //PARKING 2 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 2: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 2', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking2_tjedna = new LaravelChart($chart_options);

        //PARKING 2 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 2: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 2', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking2_mjesecna = new LaravelChart($chart_options);

        //PARKING 3 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 3: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 3', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking3_tjedna = new LaravelChart($chart_options);

        //PARKING 3 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 3: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 3', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking3_mjesecna = new LaravelChart($chart_options);
        //$math = round((($parking1thisMonthStats-$parking1lastMonthStats)/$parking1lastMonthStats)*100, 2);

/*
        $mostPopular = Event::select('parking_space_name')
                            ->groupBy('parking_space_name')
                            ->orderByRaw('COUNT(*) DESC')
                            ->take(5)
                            ->get(); */

        //PARKING 1 NAJPOPULARNIJA MJESTA
        $parking1MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                            ->where('id_parking_lot', '1')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking1MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                            ->where('id_parking_lot', '1')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking1MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                            ->where('id_parking_lot', '1')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        //PARKING 2 NAJPOPULARNIJA MJESTA
        $parking2MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                            ->where('id_parking_lot', '2')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking2MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                            ->where('id_parking_lot', '2')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking2MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                            ->where('id_parking_lot', '2')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

         //PARKING 3 NAJPOPULARNIJA MJESTA
         $parking3MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                            ->where('id_parking_lot', '3')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking3MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                            ->where('id_parking_lot', '3')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        $parking3MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                            ->where('id_parking_lot', '3')
                                            ->select('parking_space_name')
                                            ->groupBy('parking_space_name')
                                            ->orderByRaw('COUNT(*) DESC')
                                            ->take(3)
                                            ->get();

        //dd($mostPopularParkingsThisMonth);

        return view('statistics2', compact('parking1MostPopularParkingThisWeek', 'parking1MostPopularParkingsLastMonth', 'parking1MostPopularParkingsThisMonth', 'parking2MostPopularParkingThisWeek', 'parking2MostPopularParkingsLastMonth', 'parking2MostPopularParkingsThisMonth', 'parking3MostPopularParkingThisWeek', 'parking3MostPopularParkingsLastMonth', 'parking3MostPopularParkingsThisMonth', 'parking3percentage7days', 'parking3percentage30days', 'chartParking3_mjesecna', 'chartParking3_tjedna','parking2percentage30days', 'parking2percentage7days', 'chartParking2_mjesecna', 'chartParking2_tjedna', 'parking1percentage30days', 'parking1lastMonthStats', 'parking1thisMonthStats', 'parking2lastMonthStats', 'parking2thisMonthStats', 'parking3lastMonthStats', 'parking3thisMonthStats', 'chartParking1_mjesecna', 'parking1weekBeforeStats', 'parking2weekBeforeStats', 'parking3weekBeforeStats', 'parking1percentage7days', 'parking1weekStats','parking2weekStats', 'parking3weekStats', 'chartParking1_tjedna'));
    }

    public function statistics1() {

        $week = \Carbon\Carbon::today()->subDays(7);
        $week2 = \Carbon\Carbon::today()->subDays(14);
        $year = \Carbon\Carbon::today()->subYear();
        $Lastyear = \Carbon\Carbon::today()->subYear(1);

        $parking1thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1ThisYear = Event::whereYear('created_at',Carbon::now()->year)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1LastYear = Event::whereYear('created_at',Carbon::now()->subYear()->year)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();
        $parking1UkupnoStats = Event::where('id_parking_lot', '1')
                            ->get()
                            ->count();
        $parkinziUkupnoStats = Event::count();
        $parking1weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();

        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();

        $parking2weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();

        $parking3weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();

        $parking2thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '2')
                            ->count('id');

        $parking3thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '3')
                            ->count('id');

        $parking1percentage7daysDiv = $parking1weekStats + $parking2weekStats + $parking3weekStats;
        $parking1percentage7days = $parking1percentage7daysDiv > 0 ? round(($parking1weekStats / $parking1percentage7daysDiv) * 100, 2) : 0;

        $parking1percentage30daysDiv = $parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats;
        $parking1percentage30days = $parking1percentage30daysDiv > 0 ? round(($parking1thisMonthStats / $parking1percentage30daysDiv) * 100, 2) : 0;

        $parking1percentageUkupnoDiv = $parkinziUkupnoStats;
        $parking1percentageUkupno = $parking1percentageUkupnoDiv > 0 ? round(($parking1UkupnoStats / $parking1percentageUkupnoDiv) * 100, 2) : 0;

        //PARKING 1 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 1: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 1', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking1_tjedna = new LaravelChart($chart_options);

        //PARKING 1 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 1: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 1', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking1_mjesecna = new LaravelChart($chart_options);

        //PARKING 1 ukupna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 1: ukupan broj događaja',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 1', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking1_ukupna = new LaravelChart($chart_options);

        $parking1MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                                    ->where('id_parking_lot', '1')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking1MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                                    ->where('id_parking_lot', '1')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking1MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                                    ->where('id_parking_lot', '1')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking1MostPopularAllTime = Event::where('id_parking_lot', '1')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        //dd($parking1LastYear);

        return view('statistics.statistics1', compact('parking1percentageUkupno', 'parking1ThisYear', 'parking1LastYear', 'parking1UkupnoStats', 'chartParking1_ukupna', 'parking1MostPopularAllTime', 'parking1MostPopularParkingThisWeek', 'parking1MostPopularParkingsLastMonth', 'parking1MostPopularParkingsThisMonth', 'chartParking1_mjesecna', 'chartParking1_tjedna', 'parking1percentage30days', 'parking1percentage7days', 'parking1thisMonthStats', 'parking1lastMonthStats', 'parking1weekStats', 'parking1weekBeforeStats'));
    }

    public function statistics2() {

        $week = \Carbon\Carbon::today()->subDays(7);
        $week2 = \Carbon\Carbon::today()->subDays(14);
        $year = \Carbon\Carbon::today()->subYear();
        $Lastyear = \Carbon\Carbon::today()->subYear(1);

        $parking2weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();

        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();

        $parking2weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();

        $parking3weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();

        $parking1thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '1')
                            ->count('id');

        $parking2thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '2')
                            ->count('id');

        $parking3thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '3')
                            ->count('id');

        $parking2lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                            ->where('id_parking_lot', '2')
                            ->count('id');

        $parking2ThisYear = Event::whereYear('created_at',Carbon::now()->year)
                            ->where('id_parking_lot', '2')
                            ->count('id');
        $parking2LastYear = Event::whereYear('created_at',Carbon::now()->subYear()->year)
                            ->where('id_parking_lot', '2')
                            ->count('id');

        $parking2UkupnoStats = Event::where('id_parking_lot', '2')
                            ->get()
                            ->count();
        $parkinziUkupnoStats = Event::count();

        $parking2percentage7daysDiv = $parking1weekStats + $parking2weekStats + $parking3weekStats;
        $parking2percentage7days = $parking2percentage7daysDiv > 0 ? round(($parking2weekStats / $parking2percentage7daysDiv) * 100, 2) : 0;

        $parking2percentage30daysDiv = $parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats;
        $parking2percentage30days = $parking2percentage30daysDiv > 0 ? round(($parking2thisMonthStats / $parking2percentage30daysDiv) * 100, 2) : 0;

        $parking2percentageUkupnoDiv = $parkinziUkupnoStats;
        $parking2percentageUkupno = $parking2percentageUkupnoDiv > 0 ? round(($parking2UkupnoStats / $parking2percentageUkupnoDiv) * 100, 2) : 0;

        //PARKING 2 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 2: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 2', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking2_tjedna = new LaravelChart($chart_options);

        //PARKING 2 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 2: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 2', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking2_mjesecna = new LaravelChart($chart_options);

        //PARKING 2 ukupna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 2: ukupan broj događaja',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 2', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking2_ukupna = new LaravelChart($chart_options);

        $parking2MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                                    ->where('id_parking_lot', '2')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking2MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                                    ->where('id_parking_lot', '2')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking2MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                                    ->where('id_parking_lot', '2')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking2MostPopularAllTime = Event::where('id_parking_lot', '2')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        //dd($parking2LastYear);

        return view('statistics.statistics2', compact('parking2percentageUkupno', 'parkinziUkupnoStats', 'parking2UkupnoStats', 'parking2MostPopularAllTime', 'parking2LastYear', 'parking2ThisYear', 'chartParking2_ukupna', 'parking2lastMonthStats', 'parking2percentage30days', 'parking2percentage7days', 'parking2weekBeforeStats', 'parking2MostPopularParkingThisWeek', 'parking2MostPopularParkingsLastMonth', 'parking2MostPopularParkingsThisMonth','parking1weekStats', 'parking2weekStats', 'parking3weekStats', 'parking1thisMonthStats', 'parking2thisMonthStats', 'parking3thisMonthStats', 'chartParking2_tjedna', 'chartParking2_mjesecna'));
    }

    public function statistics3() {

        $week = \Carbon\Carbon::today()->subDays(7);
        $week2 = \Carbon\Carbon::today()->subDays(14);
        $year = \Carbon\Carbon::today()->subYear();
        $Lastyear = \Carbon\Carbon::today()->subYear(1);

        $parking1thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                ->where('id_parking_lot', '1')
                                ->count('id');
        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();
        $parking1weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();

        $parking1weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '1')
                            ->get()
                            ->count();

        $parking2weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '2')
                            ->get()
                            ->count();

        $parking3weekStats = Event::where('created_at','>=',$week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();

        $parking2thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '2')
                            ->count('id');

        $parking3thisMonthStats = Event::whereMonth('created_at',Carbon::now()->month)
                            ->where('id_parking_lot', '3')
                            ->count('id');

        $parking3lastMonthStats = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                            ->where('id_parking_lot', '3')
                            ->count('id');

        $parking3weekBeforeStats = Event::where('created_at','>=',$week2)
                            ->where('created_at', '<=', $week)
                            ->where('id_parking_lot', '3')
                            ->get()
                            ->count();
        $parking3UkupnoStats = Event::where('id_parking_lot', '3')
                            ->get()
                            ->count();
        $parkinziUkupnoStats = Event::count();

        $parking3ThisYear = Event::whereYear('created_at',Carbon::now()->year)
        ->where('id_parking_lot', '3')
        ->count('id');

        $parking3LastYear = Event::whereYear('created_at',Carbon::now()->subYear()->year)
        ->where('id_parking_lot', '3')
        ->count('id');

        $parking3percentage7daysDiv = $parking1weekStats + $parking2weekStats + $parking3weekStats;
        $parking3percentage7days = $parking3percentage7daysDiv > 0 ? round(($parking3weekStats / $parking3percentage7daysDiv) * 100, 2) : 0;

        $parking3percentage30daysDiv = $parking1thisMonthStats + $parking2thisMonthStats + $parking3thisMonthStats;
        $parking3percentage30days = $parking3percentage30daysDiv > 0 ? round(($parking3thisMonthStats / $parking3percentage30daysDiv) * 100, 2) : 0;

        $parking3percentageUkupnoDiv = $parkinziUkupnoStats;
        $parking3percentageUkupno = $parking3percentageUkupnoDiv > 0 ? round(($parking3UkupnoStats / $parking3percentageUkupnoDiv) * 100, 2) : 0;

        //PARKING 3 tjedna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 3: broj događaja po tjednima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 3', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'week',
            'chart_type' => 'bar',
            'chart_color' => '5,255,255',
        ];
        $chartParking3_tjedna = new LaravelChart($chart_options);

        //PARKING 3 mjesecna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 3: broj događaja po mjesecima',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 3', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking3_mjesecna = new LaravelChart($chart_options);

        //PARKING 3 ukupna statistika CHART
        $chart_options = [
            'chart_title' => 'Parking 3: ukupan broj događaja',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'conditions' =>[
                ['condition' => 'id_parking_lot = 3', 'color' => 'blue', 'fill' => 'true'],
            ],
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'chart_type' => 'line',
            'chart_color' => '0,255,255',
        ];

        $chartParking3_ukupna = new LaravelChart($chart_options);

        $parking3MostPopularParkingsThisMonth = Event::whereMonth('created_at',Carbon::now()->month)
                                                    ->where('id_parking_lot', '3')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking3MostPopularParkingsLastMonth = Event::whereMonth('created_at',Carbon::now()->subMonth()->month)
                                                    ->where('id_parking_lot', '3')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        $parking3MostPopularParkingThisWeek = Event::where('created_at','>=',$week)
                                                    ->where('id_parking_lot', '3')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();
        $parking3MostPopularAllTime = Event::where('id_parking_lot', '3')
                                                    ->select('parking_space_name')
                                                    ->groupBy('parking_space_name')
                                                    ->orderByRaw('COUNT(*) DESC')
                                                    ->take(3)
                                                    ->get();

        return view('statistics.statistics3', compact('parking3percentageUkupno', 'parking3LastYear', 'parking3ThisYear', 'parkinziUkupnoStats', 'parking3UkupnoStats', 'chartParking3_ukupna', 'parking3MostPopularAllTime', 'parking3lastMonthStats', 'parking3percentage30days', 'parking3percentage7days', 'parking3weekBeforeStats', 'parking3MostPopularParkingThisWeek', 'parking3MostPopularParkingsLastMonth', 'parking3MostPopularParkingsThisMonth','parking1weekStats', 'parking2weekStats', 'parking3weekStats', 'parking1thisMonthStats', 'parking2thisMonthStats', 'parking3thisMonthStats', 'chartParking3_tjedna', 'chartParking3_mjesecna'));
    }
}
