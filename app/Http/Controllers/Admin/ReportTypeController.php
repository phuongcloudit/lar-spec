<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReportType;

use App\Http\Requests\Admin\ReportTypeRequest;

class ReportTypeController extends Controller
{
    public function index(Request $request)
    {
        $types = ReportType::with('reports');
        if($request->has("report_type_name")){
            $types = $report_types->where("name",$request->report_type_name)->orWhere('slug',$request->report_type_name);
        }
        $limit = $request->limit?$request->limit:20;
        $types = $types->paginate($limit);
        return view('admin.report-types.index',compact('types'));
    }

    public function store(ReportTypeRequest $request)
    {
        $data = $request->only("name","slug","description");
        ReportType::create($data);
        return redirect()->route('admin.report-types.index');
    }
    public function edit(ReportType $report_type)
    {
        return view('admin.report-types.edit', compact('report_type'));
    }
    public function update(ReportTypeRequest $request, ReportType $report_type)
    {
        $data = $request->only("name","slug","description");
        $report_type->update($data);
        return redirect()->route('admin.report-types.index')->with('success','Report Type Updated sucessfully');
            
    }
    public function destroy(ReportType $report_type)
    {
        try {
            $report_type->delete();
            return redirect()->route('admin.report-types.index')->with('success','A Report Type deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.report-types.index')->with('error','Cannot delete Report Type has existing reports!');
        }
        
    }

}
