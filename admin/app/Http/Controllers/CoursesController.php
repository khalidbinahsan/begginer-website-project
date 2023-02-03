<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CoursesController extends Controller
{
    function coursesIndex(){
        return view('Courses');
    }
    function getCourseData(){
        $result = CourseModel::all();
        return $result;
    }
}
