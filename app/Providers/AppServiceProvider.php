<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // view()->composer('porto.layouts.app', function($view)
        // {
        //     $startDate = Carbon::now()->subDay(Carbon::now()->format('d')-1);
        //     $endDate = Carbon::now();
        //     $today = Analytics::fetchVisitorsAndPageViews(Period::days(1));
        //     $yesterday = Analytics::fetchVisitorsAndPageViews(Period::create(Carbon::now()->subDay(1), Carbon::now()->subDay(1)));
        //     $month = Analytics::fetchVisitorsAndPageViews(Period::create($startDate, $endDate));
        //     if(isset($today[0]['visitors'])){
        //         $countToday = $today[0]['visitors'];
        //     } else {
        //         $countToday = 0;
        //     }
        //     if(isset($yesterday[0]['visitors'])){
        //         $countYesterday = $yesterday[0]['visitors'];
        //     } else {
        //         $countYesterday = 0;
        //     }
        //     if(isset($month[0]['visitors'])){
        //         $countMonth = $month[0]['visitors'];
        //     } else {
        //         $countMonth = 0;
        //     }
        //     $view->with('today', $countToday)->with('yesterday', $countYesterday)->with('month', $countMonth);
        // });
    }
}
