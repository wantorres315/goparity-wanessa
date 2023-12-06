<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Enums\StatusEnum;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function getProject($id){
        
        $project = Project::find($id);
        return new ProjectResource($project);
     
    }

    public function projectAddValue(Request $request, $id){
        $project = Project::find($id);
        $project->wallet += $request->value;
        $project->save();
        return $project->wallet;
    }

    
}
