<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController extends Controller
{
    function ReviewIndex(){
        return view('Review');
    }
    function getReviewData(){
        $query = ReviewModel::orderBy('id', 'desc')->get();
        return $query;
    }
    function addNewReview(Request $req){
        $clientName = $req->input('clientName');
        $clientFeedback = $req->input('clientFeedback');
        $clientPhoto = $req->input('clientPhoto');
        $query = ReviewModel::insert([
            'name' => $clientName,
            'description' => $clientFeedback,
            'images' => $clientPhoto,
        ]);
        if($query == true){
            return 1;
        } else {
            return 0;
        }
    }
    function reviewDataDelete(Request $req){
        $id = $req->input('id');
        $query = ReviewModel::where('id', '=', $id)->delete();
        if ($query == true){
            return 1;
        } else {
            return 0;
        }
    }
    function getReviewById(Request $req){
        $id = $req->input('id');
        $query = ReviewModel::where('id', '=', $id)->get();
        return $query;
    }
    function reviewUpdate(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $description = $req->input('description');
        $images = $req->input('images');
        $result = ReviewModel::where('id','=', $id)->update([
            'name' => $name,
            'description' => $description,
            'images' => $images
        ]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
    }
}
