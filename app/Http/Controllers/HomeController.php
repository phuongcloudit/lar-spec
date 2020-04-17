<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $project_categories = ProjectCategory::get();
        $featured_projects  = Project::publish()->featured()->limit(10)->get();
        $new_projects       = Project::publish()->new()->limit(10)->get();
        $posts = Post::orderby("date","DESC")->limit(10)->get();
        return view('pages.home',compact('project_categories','featured_projects','new_projects','posts'));
    }
}
