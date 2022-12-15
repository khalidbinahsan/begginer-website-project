<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\servicesModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $userIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date('Y-m-d h:i:sa');
        VisitorModel::insert(['ip_address'=>$userIP, 'visit_time'=>$timeDate]);
        $servicesData = servicesModel::all();
        return view('Home', ['servicesData'=>$servicesData]);
    }
}
