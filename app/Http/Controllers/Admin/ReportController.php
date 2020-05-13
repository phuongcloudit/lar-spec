<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProjectCategory;
use App\Models\ReportType;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Auth;

use App\Http\Requests\Admin\ReportRequest;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::with(["project_category","report_type","user"]);
        $limit = $request->limit?$request->limit:20;
        $orderby = trim($request->input('orderby'));
        $orderby = in_array($orderby, ["title","user_id","project_category_id", "report_type_id", "status","featured"]) ? $orderby : 'created_at';
        $order = trim($request->input('order'))=="ASC"?"ASC":"DESC";
        $reports = $reports->orderby($orderby,$order)->paginate($limit);


        return view('admin.reports.index', compact('reports'));
    }
    public function create()
    {
        $users = User::pluck('name', 'id');
        $projectCategories = ProjectCategory::pluck('name', 'id');
        $reportTypes = ReportType::pluck('name', 'id');
        // $reportTypes->prepend('None');
        $report = new Report;
        return view('admin.reports.create')->withReport($report)->withProjectCategories($projectCategories)->withReportTypes($reportTypes)->withUsers($users);
    }

    public function store(ReportRequest $request)
    {
        
        $data = $request->only("project_category_id","report_type_id", "title", "slug", "date", "thumbnail", "content","user_id","author", "featured", "status");
        $report = Report::create($data);
        return redirect()->route('admin.reports.edit', $report)->with('success','Report has been created sucessfully');
    }
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $users = User::pluck('name', 'id');
        $projectCategories = ProjectCategory::pluck('name', 'id');
        $reportTypes = ReportType::pluck('name', 'id');
        return view('admin.reports.edit')->withReport($report)->withProjectCategories($projectCategories)->withReportTypes($reportTypes)->withUsers($users);
    }
    public function update(ReportRequest $request, Report $report)
    {
        $data = $request->only("project_category_id","report_type_id", "title", "slug", "date", "thumbnail", "content","user_id","author", "featured", "status");
        var_dump($data);
        // die();
      
        $report->update($data);
     
        return redirect()->route('admin.reports.edit', $report)->with('success','Report Updated sucessfully');
    }

    public function destroy($id)
    {
        Report::findOrFail($id)->delete();
        return redirect()->route('admin.reports.index')->with('success','A Report deleted successfully');
    }
    public function switchFeaured(Request $request, Report $report){
        $report->featured = $request->featured==1?1:0;
        $report->save();
        return response()->json(['featured'  =>  $report->featured]);
    }
    

  

}
