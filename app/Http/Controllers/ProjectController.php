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

    public function getByCategory(Request $request, $slug){
        $featured_projects  = Project::publish()->featured()->limit(10)->get();
        $projectCategories = ProjectCategory::get();
        $project_category = ProjectCategory::where("slug",$slug)->firstOrFail();
        $orderby = in_array($request->orderby, array("end_time","money","donated"))?$request->orderby:"created_at";
        $projects  = Project::publish()->where("project_category_id",$project_category->id)->orderby($orderby,"DESC")->paginate(12);
        return view('projects.category')->withFeaturedProjects($featured_projects)->withProjectCategories($projectCategories)->withProjectCategory($project_category)->withProjects($projects);
    }

    public function detail($slug){
        $projectCategories = ProjectCategory::get();
        $featured_projects  = Project::publish()->featured()->limit(10)->get();
        $project = Project::with("project_category")->where("slug",$slug)->firstOrFail();
        return view('projects.detail')->withProject($project)->withFeaturedProjects($featured_projects)->withProjectCategories($projectCategories)->withProjectCategory($project->project_category);
    }
}
