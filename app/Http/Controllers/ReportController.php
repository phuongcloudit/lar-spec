<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Report;

use App\Models\Project;
use App\Models\ReportType;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Event;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $report_first  = Report::publish()->orderby("date","DESC")->first();
        $reports  = Report::publish()->orderby("date","DESC")->where('id','<>',$report_first->id)->paginate(10);
        $reportTypes = ReportType::with('reports');
        $categories = ProjectCategory::with('reports');
        $featureReports = Report::publish()->orderby("view_count","DESC")->take(3)->get();
        $reportCategories = ProjectCategory::with('reports')->get();
        $reportTypes = ReportType::with('reports')->get();
        $featured_projects  = Project::publish()->featured()->limit(10)->get();
        $links = DB::table('reports')
                                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) report_count'))
                                ->groupBy('year')
                                ->groupBy('month')
                                ->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->get();

      
        return view('reports.index', compact('reportCategories','reportTypes','report_first','links'))->withReports($reports)->withReportTypes($reportTypes)->withCategories($categories)->withFeatureReports($featureReports)->withFeaturedProjects($featured_projects);
    }

    public function detail($slug){
        $reportTypes = ReportType::with('reports');
        $categories = ProjectCategory::with('reports');
        $report = Report::with(["project_category","report_type"])->where("slug",$slug)->firstOrFail();
        Event::dispatch('report.view', $report);
        $reportCategories = ProjectCategory::with('reports')->get();
        $reportTypes = ReportType::with('reports')->get();
        $featured_projects  = Project::publish()->featured()->limit(10)->get();
        $links = DB::table('reports')
        ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) report_count'))
        ->groupBy('year')
        ->groupBy('month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
        return view('reports.detail', compact('reportCategories','reportTypes','links'))->withReport($report)->withReportTypes($reportTypes)->withCategories($categories)->withFeaturedProjects($featured_projects);
    }

    public function getByType(Request $request, $slug){
        $report_type = ReportType::where("slug",$slug)->firstOrFail();
        $orderby = in_array($request->orderby, array("date"))?$request->orderby:"created_at";
        $reports  = Report::publish()->where("report_type_id",$report_type->id)->orderby($orderby,"DESC")->paginate(12);
        $reportCategories = ProjectCategory::with('reports')->get();
        $reportTypes = ReportType::with('reports')->get();
        $links = DB::table('reports')
        ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) report_count'))
        ->groupBy('year')
        ->groupBy('month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
        return view('reports.type', compact('reportCategories','reportTypes','links'))->withReports($reports);
    }

    public function getByProjectCategory(Request $request, $slug){
        $reportByProjectCategory = ProjectCategory::where("slug",$slug)->firstOrFail();
        $orderby = in_array($request->orderby, array("date"))?$request->orderby:"created_at";
        $reports  = Report::publish()->where("project_category_id",$reportByProjectCategory->id)->orderby($orderby,"DESC")->paginate(12);
        $reportCategories = ProjectCategory::with('reports')->get();
        $reportTypes = ReportType::with('reports')->get();
        $links = DB::table('reports')
        ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) report_count'))
        ->groupBy('year')
        ->groupBy('month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();
        return view('reports.type', compact('reportCategories','reportTypes','links'))->withReports($reports);
    }

    public function search(Request $request){
        $reports  = Report::publish()->orderby("date","DESC");
        $reportTypes = ReportType::with('reports');
        $categories = ProjectCategory::with('reports');
        $reportCategories = ProjectCategory::with('reports')->get();
        $reportTypes = ReportType::with('reports')->get();
        $links = DB::table('reports')
                                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) report_count'))
                                ->groupBy('year')
                                ->groupBy('month')
                                ->orderBy('year', 'desc')
                                ->orderBy('month', 'desc')
                                ->get();
        if($request->has("q")){
            $reports = $reports->where("title","LIKE", "%{$request->q}%")->paginate(5);
        }
        return view('reports.search', compact('reportCategories','reportTypes','links'))->withReports($reports)->withReportTypes($reportTypes)->withCategories($categories);

    }
}
