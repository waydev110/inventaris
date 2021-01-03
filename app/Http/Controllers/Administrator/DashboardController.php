<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slide;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use MainHelp;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }
}
