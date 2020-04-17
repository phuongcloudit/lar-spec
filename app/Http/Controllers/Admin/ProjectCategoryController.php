<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProjectCategory;

use App\Http\Requests\Admin\ProjectCategoryRequest;

class ProjectCategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $categories = ProjectCategory::with('projects');
        if($request->has("category_name")){
            $categories = $categories->where("name",$request->category_name)->orWhere('slug',$request->category_name);
        }
        $limit = $request->limit?$request->limit:20;
        $categories = $categories->paginate($limit);
        return view('admin.project-categories.index',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectCategoryRequest $request)
    {
        $data = $request->only("name","slug","image","description");
        ProjectCategory::create($data);
        return redirect()->route('admin.project-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectCategory $project_category)
    {
        return view('admin.project-categories.edit', compact('project_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectCategoryRequest $request, ProjectCategory $project_category)
    {
        $data = $request->only("name","slug","image","description");
        $project_category->update($data);
        return redirect()->route('admin.project-categories.index')->with('success','Category Updated sucessfully');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectCategory $project_category)
    {
        try {
            $project_category->delete();
            return redirect()->route('admin.project-categories.index')->with('success','A category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.project-categories.index')->with('error','Cannot delete category has existing projects!');
        }
        
    }
}
