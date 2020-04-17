<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProjectCategory;
use App\Models\Project;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects  = Project::publish()->paginate(12);
        return view('projects.index')->withProjects($projects);
    }

    public function getByCategory($slug){
        $projectCategories = ProjectCategory::get();
        $project_category = ProjectCategory::where("slug",$slug)->firstOrFail();
        $projects  = Project::publish()->where("project_category_id",$project_category->id)->paginate(12);
        return view('projects.category')->withProjectCategories($projectCategories)->withProjectCategory($project_category)->withProjects($projects);
    }

    public function detail($slug){
        $project = Project::with("project_category")->where("slug",$slug)->firstOrFail();
        return view('projects.detail')->withProject($project);
    }
}
