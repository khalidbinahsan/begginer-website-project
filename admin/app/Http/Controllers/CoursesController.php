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
        $result = CourseModel::orderBy('id', 'desc')->get();
        return $result;
    }
    function getDataById(Request $req){
        $id = $req->input('id');
        $result = CourseModel::where('id', '=', $id)->get();
        return $result;
    }
    function courseDataUpdate(Request $req){
        $id = $req->input('id');
        $courseName = $req->input('courseName');
        $courseDes = $req->input('courseDes');
        $courseFee = $req->input('courseFee');
        $courseTotalEnroll = $req->input('courseTotalEnroll');
        $courseLink = $req->input('courseLink');
        $courseImg = $req->input('courseImg');
        $result = CourseModel::where('id','=', $id)->update([
            'course_name' => $courseName,
            'course_des' => $courseDes,
            'course_fee' => $courseFee,
            'course_totalenroll' => $courseTotalEnroll,
            'course_link' => $courseLink,
            'course_img' => $courseImg
        ]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
    }
    function courseDataDelete(Request $req){
        $id = $req->input('id');
        $query = CourseModel::where('id', '=', $id)->delete();
        if ($query == true){
            return 1;
        } else {
            return 0;
        }
    }
    function addNewCourse(Request $req){
        $courseName = $req->input('courseName');
        $courseDes = $req->input('courseDes');
        $courseFee = $req->input('courseFee');
        $courseTotalEnroll = $req->input('courseTotalEnroll');
        $courseLink = $req->input('courseLink');
        $courseImg = $req->input('courseImg');
        $query = CourseModel::insert([
            'course_name' => $courseName,
            'course_des' => $courseDes,
            'course_fee' => $courseFee,
            'course_totalenroll' => $courseTotalEnroll,
            'course_link' => $courseLink,
            'course_img' => $courseImg
        ]);
        if($query == true){
            return 1;
        } else {
            return 0;
        }
    }
}
