<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectModel;

class ProjectController extends Controller
{
    function projectIndex(){
        $AllProjects = projectModel::orderBy('id', 'desc')->get();
        return view('Projects', ['AllProjects'=>$AllProjects]);
    }
}
