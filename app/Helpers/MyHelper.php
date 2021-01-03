<?php
namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\Link;
use App\Models\FaqCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Session;

class MyHelper{
    public static function weather($id, $icon){
        switch ($id) {
            case $id >=200 && $id <=232:
                #Thunderstorm
                return 'fog';
                break;
            case $id >=300 && $id <=321:
                # Drizzle
                return 'sleet';
                break;
            case $id >=500 && $id <=531:
                # Rain
                return 'rain';
                break;
            case $id >=600 && $id <=622:
                # Snow
                return 'snow';
                break;
            case $id >=701 && $id <=781:
                # Atmosphere
                break;
            case '800':
                # Clear
                $icon = Str::contains($icon, 'n');
                if($icon){
                    return 'clear-night';
                }else{
                    return 'clear-day';
                }
                break;
            case $id >=801 && $id <=804:
                # Cloudy
                if($id == 802){
                    return 'cloudy';
                } else {
                    $icon = Str::contains($icon, 'n');
                    if($icon){
                        return 'partly-cloudy-night';
                    }else{
                        return 'partly-cloudy-day';
                    }
                }
                break;

            default:
                return '';
                break;
        }
    }

    public static function Profil(){
        $data = DB::table('profils')->where('status', 1)->orderBy('id', 'asc')->get();
        return $data;
    }

    public static function Services(){
        $data = ServiceCategory::with(['services' => function($query){
            return $query->where('status', 1)->orderBy('id', 'asc');
        }])->where('status', 1)->orderBy('id', 'asc')->get();
        return $data;
    }

    public static function Faqs(){
        $data = FaqCategory::with(['faqs' => function($query){
            return $query->where('status', 1)->orderBy('id', 'asc');
        }])->where('status', 1)->orderBy('id', 'asc')->get();
        return $data;
    }

    public static function Wbbm(){
        $data = DB::table('wbbms')->where('status', 1)->orderBy('id', 'asc')->get();
        return $data;
    }
    public static function Menu(){
        $setting = Setting::orderBy('id', 'desc');
        $data = null;
        if($setting->count() > 0){
            $setting = $setting->first();
            $data = MenuItem::with(['submenus' => function($query){
                return $query->with(['subsubmenus' => function($query2){
                    return $query2->where('depth', 2)->orderBy('sort','asc');
                }])->where('depth', 1)->orderBy('sort','asc');
            }])->where('menu', $setting->menu_id)->where('depth', 0)->orderBy('sort', 'asc')->get();
        }
        return $data;
    }
    public static function Link(){        
        $links = Link::orderBy('id', 'asc')->get();
        return $links;
    }
    public static function Setting(){        
        $settings = Setting::limit(1)->orderBy('id', 'desc')->first();
        return $settings;
    }
}
?>
