<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\servicesModel;
use App\Models\CourseModel;
use App\Models\projectModel;
use App\Models\ContactModel;
use App\Models\reviewModel;
use App\Models\HomeSeoModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $HomeSeo = HomeSeoModel::all();
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $home_link = "http://$_SERVER[HTTP_HOST]";
        $home_title = $HomeSeo[0]['title'];
        $share_title = $HomeSeo[0]['share_title'];
        $description = $HomeSeo[0]['description'];
        $home_keywords = $HomeSeo[0]['keywords'];
        $home_img = $home_link."/".$HomeSeo[0]['page_img'];

        SEOMeta::setTitle($home_title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($home_keywords);
        SEOMeta::setCanonical($actual_link);

        OpenGraph::addImage($home_img);
        OpenGraph::setTitle($share_title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($actual_link);
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle($share_title);


        JsonLd::setTitle($home_title);
        JsonLd::setDescription($description);
        JsonLd::addImage($home_img);



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
