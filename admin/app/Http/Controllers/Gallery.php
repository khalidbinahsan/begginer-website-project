<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryModel;


class Gallery extends Controller
{
    function galleryIndex(){
        return view('Gallery');
    }
    function uploadImage(Request $request){
       $imagePath = $request->file('image')->store('public');
       $imageName = (explode('/', $imagePath))[1];
       $host = $_SERVER['HTTP_HOST'];
       $imageUrl = "http://".$host. "/storage/". $imageName;
       $result = GalleryModel::insert(['image_path'=>$imageUrl]);
       return $result;
    }
    function imageLoad(){
        return GalleryModel::orderBy('id', 'desc')->take(12)->get();
    }
    function imageLoadMore(Request $request){
        $firstId = $request->id;
        $lastId = $firstId-13;
        return GalleryModel::orderBy('id', 'desc')->where('id', '>', $lastId)->where('id', '<', $firstId)->get();
    }
    function imageDelete(Request $request){
        $id = $request->input('data-id');
        $path = $request->input('data-path');
        $dividePath = explode('/', $path);
        $imageName = end($dividePath);
        $DeleteImageFile = Storage::delete('public/'.$imageName);
        $deleteDataImage = GalleryModel::where('id', '=', $id)->delete();
        return $deleteDataImage;
        
    }
}
