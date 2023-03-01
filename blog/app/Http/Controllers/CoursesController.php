<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CoursesController extends Controller
{
    function courseIndex(){
        $AllCourses = CourseModel::orderBy('id', 'desc')->get();
        return view('Courses',['AllCourses'=>$AllCourses]);
    }
}
