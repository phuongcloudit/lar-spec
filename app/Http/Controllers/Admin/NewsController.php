<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Model\News;
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
            'datetime'=> 'required',
            'news_type' => 'required',
            'news_content' => 'required',
        ));
        $news = new News;
        $news->datetime = $request->datetime;
        $news->news_type = $request->news_type;
        $news->news_content = $request->news_content;
        $news->save();
        Session::flash('success','News created sucessfully');
        return redirect()->route('admin.news.index');
   
   
    }
}
