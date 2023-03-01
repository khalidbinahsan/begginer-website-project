<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageModel;

class MessageController extends Controller
{
    function messageIndex(){
        return view('Message');
    }
    function allMessage(){
       $query = MessageModel::orderBy('id', 'desc')->get();
       return $query;
    }
    function messageDataDelete(Request $req){
        $id = $req->input('id');
        $query = MessageModel::where('id', '=', $id)->delete();
        if ($query == true){
            return 1;
        } else {
            return 0;
        }
    }
}
