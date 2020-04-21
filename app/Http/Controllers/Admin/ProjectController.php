<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Donate;

use App\Http\Requests\Admin\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::with(["project_category","user"]);
        if($request->has("category_name")){
            $category = ProjectCategory::where("slug", $request->category_name)->first();
            if($category)
                $projects = $projects->where("project_category_id",$category->id);
        }
        if($request->has("s")){
            $projects = $projects->where("name","LIKE", "%{$request->s}%");
        }
        $limit = $request->limit?$request->limit:20;
        $orderby = trim($request->input('orderby'));
        $orderby = in_array($orderby, ['name', "project_category_id", "money", "donated", "status","featured"]) ? $orderby : 'created_at';
        $order = trim($request->input('order'))=="ASC"?"ASC":"DESC";
        $projects = $projects->orderby($orderby,$order)->paginate($limit);
        $projectCategories = ProjectCategory::get();
        return view('admin.projects.index', compact('projects'))->withProjectCategories($projectCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectCategories = ProjectCategory::pluck('name', 'id');
        $project = new Project;
        return view('admin.projects.create')->withProject($project)->withProjectCategories($projectCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        
        $data = $request->only("project_category_id", "name", "slug", "end_time", "thumbnail", "galleries", "content", "featured", "status");
        $project = Project::create($data);
        return redirect()->route('admin.projects.edit', $project)->with('success','Project has been created sucessfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $projectCategories = ProjectCategory::pluck('name', 'id');
        return view('admin.projects.edit')->withProject($project)->withProjectCategories($projectCategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->only("project_category_id", "name", "slug", "end_time", "thumbnail", "galleries", "content", "featured", "status");
        $project->update($data);

        return redirect()->route('admin.projects.edit', $project)->with('success','Post Updated sucessfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return redirect()->route('admin.projects.index')->with('success','A Post deleted successfully');
    }
    public function switchFeaured(Request $request, Project $project){
        $project->featured = $request->featured==1?1:0;
        $project->save();
        return response()->json(['featured'  =>  $project->featured]);
    }
    public function donate(Project $project){
        return view('admin.projects.donate')->withProject($project);
    }
    public function cancel(Donate $donate){        
        $donate->state = 0;
        $donate->save();
        return redirect()->route('admin.projects.donate',$donate->project_id)->with('success','Success');
    }
    public function confirm(Donate $donate){        
        $donate->state = 1;
        $donate->save();
        return redirect()->route('admin.projects.donate',$donate->project_id)->with('success','Success');
    }
    public function storeDonate(Request $request, Project $project){

        $data = [
            "project_id"       =>   $project->id,
            "trans_code"       =>   rand(0,9999999),
            "user_id"          =>   rand(0,99999999),
            "state"            =>   1,
            "money"            =>   $request->money,
            "payment_name"     =>   "現金",
            "credit_time"      =>   Carbon::now(),
            "last_update"      =>   Carbon::now(),
            "user_mail_add"    =>   "donate@specialthanks.jp",
            "user_name"        =>   "現金",
            "item_code"        =>   "SPEC".$project->id,
            "item_name"        =>   $project->name,
            "order_number"     =>   time(),
            "st_code"          =>   "現金",
            "pay_time"         =>   1,
            "epsilon_info"     =>   json_encode([])
        ];
        
        if(Donate::create($data))
            return redirect()->route('admin.projects.donate',$project)->with('success','このプロジェクトに金額を追加しました。');
        return redirect()->route('admin.projects.donate',$project)->with('error','このプロジェクトに金額が追加できませんでした。');
    }
}