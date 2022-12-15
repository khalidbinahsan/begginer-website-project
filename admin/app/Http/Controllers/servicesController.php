<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicesModel;

class servicesController extends Controller
{
    function ServicesItem(){
        return view('services');
    }
    function getServiceData(){
       $result=servicesModel::all();
       return $result; 
    }
}
