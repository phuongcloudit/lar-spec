<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index')->withNews($news);
    }
    public function create()
    {
        return view('admin.news.create');
    }
    public function store(Request $request)
    {

        $this->validate($request, array(
            'date_time'=> 'required',
            'news_type' => 'required',
            'news_content' => 'required',
        ));
        $news = new News;
        $news->date_time = $request->date_time;
        $news->news_type = $request->news_type;
        $news->news_content = $request->news_content;
        $news->save();
        Session::flash('success','News created sucessfully');
        return redirect()->route('admin.news.index');
   
   
    }
    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }
    public function update(Request $request, $id)
    {
        $news = News::find($id);
      
        $news->date_time = $request->date_time;
        $news->news_type = $request->news_type;
        $news->news_content = $request->news_content;
        $news->save();
        return redirect()->route('admin.news.index')->with('success','News Updated sucessfully');
            
    }

    public function destroy($id)
    {
        News::find($id)->delete();
        return redirect()->route('admin.news.index')->with('success','A News deleted successfully');
    }
}
