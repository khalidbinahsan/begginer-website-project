<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    function projectIndex(){
        return view('project');
    }
    function getProjectData(){
        $result = ProjectModel::orderBy('id', 'desc')->get();
        return $result;
    }
    function getProjectById(Request $req){
        $id = $req->input('id');
        $result = ProjectModel::where('id', '=', $id)->get();
        return $result;
    }
    function projectDataUpdate(Request $req){
        $id = $req->input('id');
        $projectName = $req->input('projectName');
        $projectDes = $req->input('projectDes');
        $projectLink = $req->input('projectLink');
        $projectImg = $req->input('projectImg');
        $result = ProjectModel::where('id','=', $id)->update([
            'project_name' => $projectName,
            'project_des' => $projectDes,
            'project_link' => $projectLink,
            'project_img' => $projectImg
        ]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
    }
    function projectDataDelete(Request $req){
        $id = $req->input('id');
        $query = ProjectModel::where('id', '=', $id)->delete();
        if ($query == true){
            return 1;
        } else {
            return 0;
        }
    }
    function addNewProject(Request $req){
        $projectName = $req->input('projectName');
        $projectDes = $req->input('projectDes');
        $projectLink = $req->input('projectLink');
        $projectImageLink = $req->input('projectImageLink');
        $query = ProjectModel::insert([
            'project_name' => $projectName,
            'project_des' => $projectDes,
            'project_link' => $projectLink,
            'project_img' => $projectImageLink
        ]);
        if($query == true){
            return 1;
        } else {
            return 0;
        }
    }
}
