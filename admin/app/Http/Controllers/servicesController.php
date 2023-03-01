<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicesModel;

class servicesController extends Controller
{
    // Showing a view
    function ServicesItem(){
        return view('services');
    }
    // Get all Data from services table
    function getServiceData(){
       $result=servicesModel::orderBy('id', 'desc')->get();
       return $result; 
    }
    // Delete Data from services table
    function deleteServiceData(Request $req){
        $id = $req->input('id');
        $result = servicesModel::where('id', '=', $id)->delete();
        if($result==true){
            return 1;
        } else {
            return 0;
        }
    }

    // get service data by id
    function getDataById(Request $req){
        $id = $req->input('id');
        $result = servicesModel::where('id', '=', $id)->get();
        return $result;
    }
    // Update service data by id
    function serviceUpdate(Request $req){
        $id = $req->input('id');
        $serviceName = $req->input('serviceName');
        $serviceDescription = $req->input('serviceDescription');
        $imageLink = $req->input('imageLink');
        $result = servicesModel::where('id', '=', $id)->update(['service_name'=>$serviceName, 'service_des'=> $serviceDescription, 'service_img'=> $imageLink]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
    }
    // Add New services data
    function addNewServices(Request $req){
        $name = $req->input('addName');
        $description = $req->input('addDescription');
        $imgLink = $req->input('addimageLink');
        $result = servicesModel::insert(['service_name'=>$name, 'service_des'=>$description, 'service_img'=>$imgLink]);
        if($result==true){
            return 1;
        } else {
            return 0;
        }
    }
}

