<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\servicesModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\ContactModel;
use App\Models\reviewModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $userIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date('Y-m-d h:i:sa');
        VisitorModel::insert(['ip_address'=>$userIP, 'visit_time'=>$timeDate]);
        $servicesData = servicesModel::all();
        $courseData = CourseModel::orderBy('id', 'asc')->limit(6)->get();
        $projectData = projectModel::orderBy('id', 'desc')->limit(10)->get();
        $review = reviewModel:: orderBy('id', 'desc')->get();
        return view('Home', [
            'servicesData' => $servicesData,
            'courseData' => $courseData,
            'projectData'=> $projectData,
            'review' => $review
        ]);

    }
    function contactSubmitted(Request $req){
        $contactName = $req->input('contact_name') ;
        $contactMobile =  $req->input('contact_mobile');
        $contactEmail = $req->input('contact_email') ;
        $contactMsg =  $req->input('contact_msg');
        $result = ContactModel::insert([
            'contact_name' => $contactName,
            'contact_mobile' => $contactMobile,
            'contact_email' => $contactEmail,
            'contact_msg' => $contactMsg,
        ]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
    }
}
