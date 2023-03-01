<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\servicesModel;
use App\Models\VisitorModel;
use App\Models\MessageModel;

class HomeController extends Controller
{
   function HomeIndex(){
      $TotalCourse = CourseModel::count();
      $TotalProject = ProjectModel::count();
      $TotalReview = ReviewModel::count();
      $TotalServices = servicesModel::count();
      $TotalVisitor = VisitorModel::count();
      $TotalContact = MessageModel::count();
        return view('Home', [
         'TotalCourse'=>$TotalCourse,
         'TotalProject'=>$TotalProject,
         'TotalReview'=>$TotalReview,
         'TotalServices'=>$TotalServices,
         'TotalVisitor'=>$TotalVisitor,
         'TotalContact'=>$TotalContact
        ]);
   }
   
}
