<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function VisitorList(){
        $VisitorData = VisitorModel::orderBy('id', 'desc')->take(500)->get();
        // when you want to pass a variable value by a view you should set a key and it's value.
        return view('Visitor', ['VisitorData' => $VisitorData]);
    }
}
